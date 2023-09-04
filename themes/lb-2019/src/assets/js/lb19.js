// Esta funcion se encarga de agregar los tipos de MDL a los campos tipo input/submint/textarea
const Form2MDL = () => {
  console.log("Form to MDL")
  // let elements = document.querySelectorAll("input, textarea, button")
  let elements = document.querySelectorAll("input, textarea")
  Object.keys(elements).forEach( e => {
    let mdl_text_class = "mdl-textfield__input";
    let mdl_button_class = "mdl-button mdl-js-button mdl-button--raised mdl-color--secondary mdl-color-text--secondary";
    let classes = [];

    switch (elements[e].type) {
      case "text":
      case "email":
      case "textarea":
      case "url":
      case "number":
        classes = elements[e].className.split(" ");
        if ( ! classes.includes(mdl_text_class) ) {
          elements[e].className += " " + mdl_text_class;
        }
        break;
      case "submit":
        console.log(elements[e]);
        classes = elements[e].className.split(" ");
        if ( ! classes.includes(mdl_button_class) ) {
          console.log("Agregando las clases MDL");
          elements[e].className += " " + mdl_button_class;
        } else {
          console.log("Ya tiene las clases MDL");
        }
        break;

      // case "radio":
      //   classes = elements[e].className.split(" ");
      //   if ( ! classes.includes("mdl-checkbox__ripple-container") ) {
      //     elements[e].className += " " + "mdl-checkbox__ripple-container";
      //   }
      //   break;

      case "hidden":
        // Nada que hacer
        break;

      default:
        console.log(elements[e].type);
    }
  })
}
Form2MDL();
