<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    function alert(title, message, type = "warning") {
        let bs_class = "alert-" + type;
        let element = document.createElement('div');
        element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
            <strong>${title} !</strong> ${message}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;

        document.body.appendChild(element);
    }
</script>

<script>
    let general_data, contacts_data;

    let general_settings_form = document.getElementById('general_settings_form');
    let site_title_input = document.getElementById('site_title_input');
    let site_about_input = document.getElementById('site_about_input');

    let contacts_settings_form = document.getElementById('contacts_settings_form');

    function get_general_data() {
        // Getting the inner text
        let site_title = document.getElementById('site_title');
        let site_about = document.getElementById('site_about');

        let shutdown_toggle = document.getElementById("shutdown-toggle");

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            general_data = JSON.parse(this.responseText);

            // Setting the inner text
            site_title.innerText = general_data.site_title;
            site_about.innerText = general_data.site_about;

            site_title_input.value = general_data.site_title;
            site_about_input.value = general_data.site_about

            if (general_data.shutdown == 0) {
                shutdown_toggle.checked = false;
                shutdown_toggle.value = 0;
            } else {
                shutdown_toggle.checked = true;
                shutdown_toggle.value = 1;
            }
        }

        xhr.send('get_general_data');
    }

    general_settings_form.addEventListener('submit', function(e) {
        e.preventDefault();
        update_general_data(site_title_input.value, site_about_input.value);
    });

    function update_general_data(site_title_value, site_about_value) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {

            var modalReference = document.getElementById('general-settings');
            var modal = bootstrap.Modal.getInstance(modalReference);
            modal.hide();

            if (this.responseText == 1) {
                alert("Success", "Changes saved", "success")
                get_general_data();
            } else {
                alert("Attention", "No Changes saved")
            }
        }

        xhr.send('site_title=' + site_title_value + '&site_about=' + site_about_value + '&update_general_data');
    }

    function update_shutdown(val) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.responseText == 1 && general_data.shutdown == 0) {
                alert("Attention", "Site has been shutdowned!")
            } else {
                alert("Attention", "Site is Live!")
            }
            get_general_data();
        }

        xhr.send('update_shutdown=' + val);
    }

    function get_contacts_data() {

        let contacts_ids = ['address', 'googleMap', 'phone_number_1', 'phone_number_2', 'email', 'facebook', 'instagram', 'twitter'];
        let iframe = document.getElementById('iframe');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            contacts_data = JSON.parse(this.responseText);
            contacts_data = Object.values(contacts_data)

            for (i = 0; i < contacts_ids.length; i++) {
                document.getElementById(contacts_ids[i]).innerText = contacts_data[i + 1];
            }
            iframe.src = contacts_data[9];
            contacts_inputs(contacts_data)
        }

        xhr.send('get_contacts_data');
    }

    function contacts_inputs(data) {
        let contacts_input_ids = ['address_input', 'googleMap_input', 'phone_number_1_input', 'phone_number_2_input', 'email_input', 'facebook_input', 'instagram_input', 'twitter_input', 'iframe_input'];

        for (i = 0; i < contacts_input_ids.length; i++) {
            document.getElementById(contacts_input_ids[i]).value = data[i + 1];
        }
    }

    contacts_settings_form.addEventListener('submit', function(e) {
        e.preventDefault();
        update_contacts_data();
    })

    function update_contacts_data() {
        let contacts_ids = ['address', 'googleMap', 'phone_number_1', 'phone_number_2', 'email', 'facebook', 'instagram', 'twitter', 'iframe'];
        let contacts_input_ids = ['address_input', 'googleMap_input', 'phone_number_1_input', 'phone_number_2_input', 'email_input', 'facebook_input', 'instagram_input', 'twitter_input', 'iframe_input'];

        let data_str = "";

        for (i = 0; i < contacts_ids.length; i++) {
            data_str += contacts_ids[i] + "=" + document.getElementById(contacts_input_ids[i]).value + '&'
        }
        data_str += "update_contacts_data";

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/settings_crud.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {

            var modalReference = document.getElementById('contacts-settings');
            var modal = bootstrap.Modal.getInstance(modalReference);
            modal.hide();

            if (this.responseText == 1) {
                alert("Success", "Changes saved", "success")
                get_contacts_data();
            } else {
                alert("Attention", "No Changes saved")
            }
        }

        xhr.send(data_str);
    }

    window.onload = function() {
        get_general_data();
        get_contacts_data();
    }
</script>