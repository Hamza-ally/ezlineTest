class SweetAlert{

    constructor(){
        
    }

    uniSwal_Response(header, body, icon){
        swal({
            title: header,
            html: true, // Enable HTML in the message
            content: {
                element: "div",
                attributes: {
                    innerHTML: body.replace(/\n/g, '<br>') // Replace newline characters with <br> for line breaks
                }
            },
            icon: icon,
            button: {
              text: "Okay",
              value: true,
              visible: true,
              className: "btn btn-primary"
            }
        });
    }

    errorSwal(message){
        swal({
            title: 'Error!',
            text: message,
            icon: 'error',
            button: {
              text: "Okay",
              value: true,
              visible: true,
              className: "btn btn-primary"
            }
        });
    }

    successSwal(message){
        swal({
            title: 'Congratulations!',
            text: message,
            icon: 'success',
            button: {
              text: "Okay",
              value: true,
              visible: true,
              className: "btn btn-primary"
            }
        });
    }

    confirmationSwal() {
        return new Promise(function (resolve, reject) {
            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3f51b5",
                cancelButtonColor: "#ff4081",
                confirmButtonText: "Great ",
                closeOnClickOutside: false,
                allowOutsideClick: false,
                buttons: {
                    cancel: {
                        text: "Cancel!",
                        value: false,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Proceed!",
                        value: true,
                        visible: true,
                        className: "btn btn-primary",
                        closeModal: true,
                    },
                },
            }).then(function (result) {
                resolve(result);
            });
        });
    }

    Unitoast(heading, text, icon) {
        // resetToastPosition(heading, text, icon);
        $.toast({
            heading: heading,
            text: text,
            showHideTransition: "slide",
            icon: icon,
            loaderBg: "#f96868",
            position: "top-center",
        });
    };
}

const sweetAlert = new SweetAlert();
