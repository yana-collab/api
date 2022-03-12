var elem = document.getElementById('point');
var modal = document.getElementById('show-modal');



function showModal() {
        document.addEventListener('mousemove', function (event) {
            if (event.pageY < 10) {
                modal.style.display = "block";
            }
        })
}
showModal();


function closeModal() {
    var closeButton = document.getElementById('close-modal');
    closeButton.addEventListener('click', function (event) {
        if(event.target) {
            modal.style.display = "none";
        }
    })
}

closeModal();