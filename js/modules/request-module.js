// It handles requests

export class Request {
     static async sendAJAX(form, fileName) {
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
}