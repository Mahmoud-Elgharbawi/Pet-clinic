function validateForm() {
            var z = document.forms["myForm"]["Email"].value;
            atpos = z.indexOf("@");
            if (atpos < 1) 
                {
                alert("email must contain @ character")
                document.myForm.z.focus() ;
                return false;
                }
            if (z == "") {

                alert("Email must be filled out");
                return false;

            }

            var y = document.forms["myForm"]["password"].value;
            if (y == "") {

                alert("password must be filled out");
                return false;
                }

            else{
                return true;

            }
}
