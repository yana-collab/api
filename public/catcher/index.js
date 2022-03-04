var elem = document.getElementById('point');
var modal = document.getElementById('show-modal');
var closeModal = document.getElementById('close-modal');

const show = true;

function showModal() {

        document.addEventListener('mousemove', function (event) {
            if (event.pageY < 10) {
                modal.style.display = "block";

            }
        })
}
showModal();


function closeModal() {
    var closeModal = document.getElementById('close-modal');
    closeModal.addEventListener('click', function (event) {
        if(event.target) {
            modal.style.display = "none";
            show = false;
        }
    })
}
