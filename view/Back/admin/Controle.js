function validateForm() {
    console.log("validateForm called");
      var nom = document.getElementById("nom").value;
      var email = document.getElementById('email').value;
      var ville = document.getElementById('ville').value;
    
      var nomerror = document.getElementById("nomerror");
      var villeerror = document.getElementById("villeerror");
      var emailerror = document.getElementById('emailerror');
      
    
      var isValid = true;
    
        if(nom.trim() === "")
        {
            nomerror.innerHTML = "Nom est requis";
            isValid = false;
        } else if(!/[A-Z]/.test(nom))
        {
            nomerror.innerHTML = "Nom doit contenir une lettre majuscule";
            isValid = false;
        }  else 
        {
            nomerror.innerHTML="";
        }


        if(email.trim() === "")
          {
              emailerror.innerHTML= "Email is required";
              isValid = false;
          } else if(!/\S+@\S+\.\S+/.test(email))
          {
              emailerror.innerHTML = "Email must be valid";
              isValid = false ;
          } else
          {
              emailerror.innerHTML = "";
          }


          if(ville.trim() === "")
            {
                villeerror.innerHTML = "Ville est requis";
                isValid = false;
            }  else if(ville.length < 5)
            {
                villeerror.innerHTML = "Ville doit contenir au moins 5 caractères";
                isValid = false;
            } else 
            {
                villeerror.innerHTML="";
            }

      

      return isValid;    //// true
    }
    