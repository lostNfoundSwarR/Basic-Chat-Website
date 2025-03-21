// It handles requests
// NOTE: Its not applicable for all requests
export async sendAJAX(form, fileName) {
     let formData = new FormData(form);

     try{
          await fetch(`php/${fileName}.php`,
               {
                    method: "POST",
                    body: formData
               }
          );
     }
     catch(error) {
          console.error(error);
     }
}
