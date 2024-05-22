<script type="text/javascript">
        //declare Variables to be used
        var divs = ["errorFirst", "errorLast","erroremail", "errorpassword", "errorcontact", "errormanager_id","errorusrname" ];

        //Validation function
        function validate() {
            //just for input element
            var inputs = [
                document.getElementById('first_name').value,
                document.getElementById('last_name').value,
                document.getElementById('email').value,
                document.getElementById('Password').value
                document.getElementById('contact').value,
                document.getElementById('manager_id').value,
                document.getElementById('username').value
                
                
            ];

            //just for errors
            var errors = [
                "Please enter your First name!",
                "Please enter your Last name!",
                "Please enter your Email!",
                "Please enter your Password!"
                "Please enter your contact!",
                "Please enter your manager_id!",
                "Please enter your username!",
                
            ];

            //we need to iterate through inputs
            for (var i = 0; i < inputs.length; i++) {
                var errorMessage = errors[i];
                var div = divs[i];
                if (inputs[i] == "") {
                    document.getElementById(div).innerHTML = errorMessage;
                } else {
                    document.getElementById(div).innerHTML = "OK!";
                }
            }
        }

        function finalValidate() {
            var count = 1;
            for (var i = 1; i < 7; i++) {
                var div = divs[i];
                if (document.getElementById(div).innerHTML == "OK!") {
                    count++;
                }
            }
            if (count == 7) {
                document.getElementById("errorfinal").innerHTML = "All the data you entered are correct!";
            }
        }
    </script>
