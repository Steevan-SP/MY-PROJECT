    <div class="card-body">
    <!-- Guest Mode -->
    <div class="mb-3 row">
                <label class="col-lg-4 col-form-label">Select Guest Type<span class="text-danger">*</span></label>
                <div class="col-lg-6 d-flex">
                    <div class="form-check form-check-inline me-3">
                        <input class="form-check-input" type="radio" name="guest_type" id="localRadio" value="local">
                        <label class="form-check-label" for="localRadio">Local</label>
                    </div>
                    <div class="form-check form-check-inline me-3">
                        <input class="form-check-input" type="radio" name="guest_type" id="foreignRadio" value="foreign">
                        <label class="form-check-label" for="foreignRadio">Foreign</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="guest_type" id="complementaryRadio" value="complementary">
                        <label class="form-check-label" for="complementaryRadio">Complementary</label>
                    </div>
                </div>
            </div>
<!-- Guest Mode -->
    <div id="mainForm" name="mainForm" class="">
            <div class="mb-3 row">
                <label class="col-lg-4 col-form-label" for="title">Title<span class="text-danger">*</span></label>
                 <div class="col-lg-6">
                    <select class="form-select" id="title" name="title" required>
                        <option value="" disabled selected>Select</option>
                        <option value="rev">Rev</option>
                        <option value="mr">Mr</option>
                        <option value="mrs">Mrs</option>
                        <option value="master">Master</option>
                        <option value="miss">Miss</option>
                        <option value="dr">Dr</option>
                    </select>
                    <div class="invalid-feedback">Please select a title.</div>
                </div>
            </div>

            <div class="row">
	<div class="mb-1 col-md-6">
		<label class="col-lg-6 col-form-label" for="guestfirstname">Guest First Name<span class="text-danger">*</span></label>
		<input type="text" class="form-control" id="guestfirstname" name="guestfirstname" placeholder="Guest First Name" required>
                    <div class="invalid-feedback">Please enter the Guest Name...</div>
	</div>
	<div class="mb-1 col-md-6">
		<label class="col-lg-6 col-form-label" for="guestlastname">Guest Last Name<span class="text-danger">*</span></label>
		 <input type="text" class="form-control" id="guestlastname" name="guestlastname" placeholder="Guest Last Name" required>
                    <div class="invalid-feedback">Please enter the Guest Last Name...</div>
	</div>
</div>
     
<!-- Local Guest -->
<div id="localForm" name="localForm" class="d-none">
    <h2>Local Form</h2>
    <form id="addressForm" class="needs-validation" novalidate>
        <!-- Address Line 1 -->
        <div class="mb-3 row">
            <label class="col-lg-4 col-form-label" for="addressline1">Address Line - 01<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="addressline1" name="addressline1" placeholder="Enter the Address line - 01" required>
                <div class="invalid-feedback">Enter the Address Line 1.</div>
            </div>
        </div>

        <!-- Address Line 2 -->
        <div class="mb-3 row">
            <label class="col-lg-4 col-form-label" for="addressline2">Address Line - 02</label>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="addressline2" name="addressline2" placeholder="Enter the Address line - 02">
                <div class="invalid-feedback">Enter the Address Line 2.</div>
            </div>
        </div>

        <!-- City -->
        <div class="mb-3 row">
            <label class="col-lg-4 col-form-label" for="city">City<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="city" name="city" placeholder="City" required value = ${data.city}>
                <div class="invalid-feedback">Enter the City.</div>
            </div>
        </div>

        <!-- Phone -->
        <div class="mb-3 row">
            <label class="col-lg-4 col-form-label" for="phone">Phone (SL)<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <input type="text" class="form-control" id="phone" name="phone" placeholder="0700000000" required>
                <span id="phoneError" class="text-danger"></span>
            </div>
        </div>
    </form>
    
    <!-- Search Form -->
    <form id="searchForm" method="GET" class="ml-auto">
        <div class="mb-3 row">
            <label class="col-lg-4 col-form-label" for="id_number">National ID Card Number<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <div class="input-group search-area">
                    <input type="text" name="search" class="form-control" id="id_number" placeholder="Search by ID number ..." required>
                    <span class="input-group-text">
                        <button type="button" id="searchButton"><i class="flaticon-381-search-2"></i></button>
                    </span>
                </div>
                <span id="IdError" class="text-danger"></span>
            </div>
        </div>
    </form>

    <div id="result" class="d-none"></div>
</div>

<script>
document.getElementById('searchButton').addEventListener('click', function() {
    const idNumber = document.getElementById('id_number').value.trim();
    const resultDiv = document.getElementById('result');
    const idError = document.getElementById('IdError');

    idError.textContent = '';

    if (idNumber === '') {
        idError.textContent = 'ID number is required.';
        resultDiv.classList.add('d-none');
        return;
    }

    const url = `{{ route('search.guest') }}?search=${encodeURIComponent(idNumber)}`;

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                resultDiv.classList.remove('d-none');
                resultDiv.innerHTML = `
                    <h3>Guest Details</h3>
                    <p><strong>Address Line 1:</strong> ${data.addressline1}</p>
                    <p><strong>Address Line 2:</strong> ${data.addressline2 || 'N/A'}</p>
                    <p><strong>City:</strong> ${data.city}</p>
                    <p><strong>Phone:</strong> ${data.phone}</p>
                    <p><strong>Registration Date:</strong> ${data.registration_date}</p>
                `;
            } else {
                idError.textContent = 'ID number not found.';
                resultDiv.classList.add('d-none');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            idError.textContent = 'An error occurred.';
            resultDiv.classList.add('d-none');
        });
});
</script>




<!-- Foreign Guest -->
     <div id="foreignForm" class="d-none">
             <h2>Foreign Form</h2>
            <div class="mb-3 row">
                <label class="col-lg-4 col-form-label" for="country">Country<span class="text-danger">*</span></label>
            <div class="col-lg-6">
                 <select class="form-select" id="country" name="country">
                    <option value="" disabled selected>Select Country</option>
                 <?php
            $country_list = array(
        
                "AF" => "Afghanistan",
                "AL" => "Albania",
                "DZ" => "Algeria",
                "AS" => "American Samoa",
                "AD" => "Andorra",
                "AO" => "Angola",
                "AI" => "Anguilla",
                "AQ" => "Antarctica",
                "AG" => "Antigua and Barbuda",
                "AR" => "Argentina",
                "AM" => "Armenia",
                "AW" => "Aruba",
                "AU" => "Australia",
                "AT" => "Austria",
                "AZ" => "Azerbaijan",
                "BS" => "Bahamas",
                "BH" => "Bahrain",
                "BD" => "Bangladesh",
                "BB" => "Barbados",
                "BY" => "Belarus",
                "BE" => "Belgium",
                "BZ" => "Belize",
                "BJ" => "Benin",
                "BM" => "Bermuda",
                "BT" => "Bhutan",
                "BO" => "Bolivia",
                "BA" => "Bosnia and Herzegovina",
                "BW" => "Botswana",
                "BV" => "Bouvet Island",
                "BR" => "Brazil",
                "BQ" => "British Antarctic Territory",
                "IO" => "British Indian Ocean Territory",
                "VG" => "British Virgin Islands",
                "BN" => "Brunei",
                "BG" => "Bulgaria",
                "BF" => "Burkina Faso",
                "BI" => "Burundi",
                "KH" => "Cambodia",
                "CM" => "Cameroon",
                "CA" => "Canada",
                "CT" => "Canton and Enderbury Islands",
                "CV" => "Cape Verde",
                "KY" => "Cayman Islands",
                "CF" => "Central African Republic",
                "TD" => "Chad",
                "CL" => "Chile",
                "CN" => "China",
                "CX" => "Christmas Island",
                "CC" => "Cocos [Keeling] Islands",
                "CO" => "Colombia",
                "KM" => "Comoros",
                "CG" => "Congo - Brazzaville",
                "CD" => "Congo - Kinshasa",
                "CK" => "Cook Islands",
                "CR" => "Costa Rica",
                "HR" => "Croatia",
                "CU" => "Cuba",
                "CY" => "Cyprus",
                "CZ" => "Czech Republic",
                "CI" => "Côte d’Ivoire",
                "DK" => "Denmark",
                "DJ" => "Djibouti",
                "DM" => "Dominica",
                "DO" => "Dominican Republic",
                "NQ" => "Dronning Maud Land",
                "DD" => "East Germany",
                "EC" => "Ecuador",
                "EG" => "Egypt",
                "SV" => "El Salvador",
                "GQ" => "Equatorial Guinea",
                "ER" => "Eritrea",
                "EE" => "Estonia",
                "ET" => "Ethiopia",
                "FK" => "Falkland Islands",
                "FO" => "Faroe Islands",
                "FJ" => "Fiji",
                "FI" => "Finland",
                "FR" => "France",
                "GF" => "French Guiana",
                "PF" => "French Polynesia",
                "TF" => "French Southern Territories",
                "FQ" => "French Southern and Antarctic Territories",
                "GA" => "Gabon",
                "GM" => "Gambia",
                "GE" => "Georgia",
                "DE" => "Germany",
                "GH" => "Ghana",
                "GI" => "Gibraltar",
                "GR" => "Greece",
                "GL" => "Greenland",
                "GD" => "Grenada",
                "GP" => "Guadeloupe",
                "GU" => "Guam",
                "GT" => "Guatemala",
                "GG" => "Guernsey",
                "GN" => "Guinea",
                "GW" => "Guinea-Bissau",
                "GY" => "Guyana",
                "HT" => "Haiti",
                "HM" => "Heard Island and McDonald Islands",
                "HN" => "Honduras",
                "HK" => "Hong Kong SAR China",
                "HU" => "Hungary",
                "IS" => "Iceland",
                "IN" => "India",
                "ID" => "Indonesia",
                "IR" => "Iran",
                "IQ" => "Iraq",
                "IE" => "Ireland",
                "IM" => "Isle of Man",
                "IL" => "Israel",
                "IT" => "Italy",
                "JM" => "Jamaica",
                "JP" => "Japan",
                "JE" => "Jersey",
                "JT" => "Johnston Island",
                "JO" => "Jordan",
                "KZ" => "Kazakhstan",
                "KE" => "Kenya",
                "KI" => "Kiribati",
                "KW" => "Kuwait",
                "KG" => "Kyrgyzstan",
                "LA" => "Laos",
                "LV" => "Latvia",
                "LB" => "Lebanon",
                "LS" => "Lesotho",
                "LR" => "Liberia",
                "LY" => "Libya",
                "LI" => "Liechtenstein",
                "LT" => "Lithuania",
                "LU" => "Luxembourg",
                "MO" => "Macau SAR China",
                "MK" => "Macedonia",
                "MG" => "Madagascar",
                "MW" => "Malawi",
                "MY" => "Malaysia",
                "MV" => "Maldives",
                "ML" => "Mali",
                "MT" => "Malta",
                "MH" => "Marshall Islands",
                "MQ" => "Martinique",
                "MR" => "Mauritania",
                "MU" => "Mauritius",
                "YT" => "Mayotte",
                "FX" => "Metropolitan France",
                "MX" => "Mexico",
                "FM" => "Micronesia",
                "MI" => "Midway Islands",
                "MD" => "Moldova",
                "MC" => "Monaco",
                "MN" => "Mongolia",
                "ME" => "Montenegro",
                "MS" => "Montserrat",
                "MA" => "Morocco",
                "MZ" => "Mozambique",
                "MM" => "Myanmar [Burma]",
                "NA" => "Namibia",
                "NR" => "Nauru",
                "NP" => "Nepal",
                "NL" => "Netherlands",
                "AN" => "Netherlands Antilles",
                "NT" => "Neutral Zone",
                "NC" => "New Caledonia",
                "NZ" => "New Zealand",
                "NI" => "Nicaragua",
                "NE" => "Niger",
                "NG" => "Nigeria",
                "NU" => "Niue",
                "NF" => "Norfolk Island",
                "KP" => "North Korea",
                "VD" => "North Vietnam",
                "MP" => "Northern Mariana Islands",
                "NO" => "Norway",
                "OM" => "Oman",
                "PC" => "Pacific Islands Trust Territory",
                "PK" => "Pakistan",
                "PW" => "Palau",
                "PS" => "Palestinian Territories",
                "PA" => "Panama",
                "PZ" => "Panama Canal Zone",
                "PG" => "Papua New Guinea",
                "PY" => "Paraguay",
                "YD" => "People's Democratic Republic of Yemen",
                "PE" => "Peru",
                "PH" => "Philippines",
                "PN" => "Pitcairn Islands",
                "PL" => "Poland",
                "PT" => "Portugal",
                "PR" => "Puerto Rico",
                "QA" => "Qatar",
                "RO" => "Romania",
                "RU" => "Russia",
                "RW" => "Rwanda",
                "RE" => "Réunion",
                "BL" => "Saint Barthélemy",
                "SH" => "Saint Helena",
                "KN" => "Saint Kitts and Nevis",
                "LC" => "Saint Lucia",
                "MF" => "Saint Martin",
                "PM" => "Saint Pierre and Miquelon",
                "VC" => "Saint Vincent and the Grenadines",
                "WS" => "Samoa",
                "SM" => "San Marino",
                "SA" => "Saudi Arabia",
                "SN" => "Senegal",
                "RS" => "Serbia",
                "CS" => "Serbia and Montenegro",
                "SC" => "Seychelles",
                "SL" => "Sierra Leone",
                "SG" => "Singapore",
                "SK" => "Slovakia",
                "SI" => "Slovenia",
                "SB" => "Solomon Islands",
                "SO" => "Somalia",
                "ZA" => "South Africa",
                "GS" => "South Georgia and the South Sandwich Islands",
                "KR" => "South Korea",
                "ES" => "Spain",
                "LK" => "Sri Lanka",
                "SD" => "Sudan",
                "SR" => "Suriname",
                "SJ" => "Svalbard and Jan Mayen",
                "SZ" => "Swaziland",
                "SE" => "Sweden",
                "CH" => "Switzerland",
                "SY" => "Syria",
                "ST" => "São Tomé and Príncipe",
                "TW" => "Taiwan",
                "TJ" => "Tajikistan",
                "TZ" => "Tanzania",
                "TH" => "Thailand",
                "TL" => "Timor-Leste",
                "TG" => "Togo",
                "TK" => "Tokelau",
                "TO" => "Tonga",
                "TT" => "Trinidad and Tobago",
                "TN" => "Tunisia",
                "TR" => "Turkey",
                "TM" => "Turkmenistan",
                "TC" => "Turks and Caicos Islands",
                "TV" => "Tuvalu",
                "UM" => "U.S. Minor Outlying Islands",
                "PU" => "U.S. Miscellaneous Pacific Islands",
                "VI" => "U.S. Virgin Islands",
                "UG" => "Uganda",
                "UA" => "Ukraine",
                "SU" => "Union of Soviet Socialist Republics",
                "AE" => "United Arab Emirates",
                "GB" => "United Kingdom",
                "US" => "United States",
                "ZZ" => "Unknown or Invalid Region",
                "UY" => "Uruguay",
                "UZ" => "Uzbekistan",
                "VU" => "Vanuatu",
                "VA" => "Vatican City",
                "VE" => "Venezuela",
                "VN" => "Vietnam",
                "WK" => "Wake Island",
                "WF" => "Wallis and Futuna",
                "EH" => "Western Sahara",
                "YE" => "Yemen",
                "ZM" => "Zambia",
                "ZW" => "Zimbabwe",
                "AX" => "Aland Islands",
                );

            foreach ($country_list as $country) {
                echo "<option value=\"$country\">$country</option>";
            }
            ?>
        </select>
                <div class="invalid-feedback">
                     Enter the guest Country.
                 </div>
            </div>
        </div>

             <div class="mb-3 row">
                <label class="col-lg-4 col-form-label" for="passport_number">Passport Number<span class="text-danger">*</span></label>
                    <div class="col-lg-6">
                       <div class="input-group">
                         <input type="text" class="form-control" id="passport_number" name="passport_number" placeholder="000000000X/Z" >
                              <div class="invalid-feedback">
                                Enter Guest Passport Number.
                              </div>
                          </div>
                     </div>
                 </div>

            <div class="mb-3 row">
                <label class="col-lg-4 col-form-label" for="image_path">Image Upload<span class="text-danger">*</span></label>
                    <div class="col-lg-6">
                      <div class="input-group">
                        <input type="file" class="form-file-input form-control" id="image_path" name="image_path"accept="image/*">
                   </div>
               </div>
        </div>


        <!-- Driver Detail -->
        <fieldset class="mb-3">
    <div class="row">
        <label class="col-lg-4 col-form-label">Is Driver Available (SL)?<span class="text-danger">*</span></label>
        <div class="col-lg-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="driverRadios" id="yesRadio" value="yes">
                <label class="form-check-label" for="yesRadio">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="driverRadios" id="noRadio" value="no">
                <label class="form-check-label" for="noRadio">No</label>
            </div>
        </div>
    </div>
</fieldset>



        <div id="driverForm" class="d-none">
        <div class="row">
	        <div class="mb-1 col-md-6">
		        <label class="col-lg-6 col-form-label" for="driver_name">Driver Name<span class="text-danger">*</span></label>
		            <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Driver Name" >
                        <div class="invalid-feedback">Please enter the Driver Name...</div>
	        </div>
	        <div class="mb-1 col-md-6">
		        <label class="col-lg-6 col-form-label" for="vehicle_number">Vehicle Number<span class="text-danger">*</span></label>
		            <input type="text" class="form-control" id="vehicle_number" name="vehicle_number" placeholder="Vehicle Number" >
                        <div class="invalid-feedback">Please enter the Vehicle Number</div>
	                </div>
                 </div>
                    </div>

            </div>


        <div class="mb-3 row">
                <label class="col-lg-4 col-form-label" for="email">Guest Email <span class="text-danger">*</span></label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Guest valid email.." required>
                    <div class="invalid-feedback">Please enter a valid email.</div>
                </div>
            </div>
<!-- Complementary Guest -->
        <div id="complementaryForm" class="d-none">
           
                <h2>Complementary Form</h2>
                <div class="mb-3 row">
                        <label class="col-lg-4 col-form-label" for="complementary_reason">Reason For Complementary <span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="complementary_reason"  name="complementary_reason" rows="5" placeholder=" Complementary Reason" ></textarea>
                                    <div class="invalid-feedback">
                                        Mention the complementary Reason...
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                        <div class="mb-1 col-md-6">
                            <label class="col-lg-6 col-form-label" for="adult_count">Adults Count <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="adult_count" name="adult_count"placeholder="Adult (18 to Above)" required="">
					                    <div class="invalid-feedback">
											Please Enter the Adult count..
										</div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                    <label class="col-lg-4 col-form-label" for="kids_count">Kids Count</label>
                                    <input type="text" class="form-control" id="kids_count" name="kids_count"placeholder="Kids age limit (12 to 17)">
                                    </div>
                                </div>

        </div>
 </div>

 @section('js')
<script>
$(document).ready(function() {
    $('input[name="guest_type"]').change(function() {
        var guest_typeName = $(this).val();
        if (guest_typeName == 'local') {
            $('#localForm').removeClass('d-none');
            $('#foreignForm').addClass('d-none');
            $('#complementaryForm').addClass('d-none');
        } else if (guest_typeName  == 'foreign') {
            $('#foreignForm').removeClass('d-none');
            $('#localForm').addClass('d-none');
            $('#complementaryForm').addClass('d-none');
        } else {
            $('#complementaryForm').removeClass('d-none');
            $('#foreignForm').addClass('d-none');
            $('#localForm').addClass('d-none');
        }
    });

    $('input[name="driverRadios"]').change(function() {
        var isDriverAvailable = $(this).val();
        if (isDriverAvailable == 'yes') {
            $('#driverForm').removeClass('d-none');
        } else {
            $('#driverForm').addClass('d-none');
        }
    });
    
        $('#phone').on('input', function() {
            var phoneInput = $(this).val();
            var phoneError = $('#phoneError');

            if (!phoneInput) {
                phoneError.text("Please enter phone number");
            } else if (phoneInput.length < 10) {
                phoneError.text("Phone number must be exactly 10 digits");
            } else if (phoneInput.length > 10) {
                phoneError.text("Phone number cannot exceed 10 digits");
            } else {
                phoneError.text("");
            }
        });

        $('#id_number').on('input', function() {
    var id_numberInput = $(this).val();
    var id_numberError = $('#IdError');

    if (!id_numberInput) {
        id_numberError.text("Please enter national ID number");
    } else if (id_numberInput.length !== 10 && id_numberInput.length !== 12) {
        id_numberError.text("ID number must be either 9 or 12 digits");
    } else {
        id_numberError.text("");
    }
});

});
</script>

@endsection
     
 