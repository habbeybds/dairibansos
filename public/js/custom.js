// event pada saat click nav link
$(".page-scroll").on("click", function (e) {
    //ambil isi href
    var href = $(this).attr("href");

    //tangkap element nav link
    var destination = $(href);

    //scroll section
    $("html , body").animate({
        scrollTop: destination.offset().top,
    });

    e.preventDefault();
});

//Change Color Btn Masuk
const btn = document.querySelector("#btn-masuk");
btn.style.backgroundColor = "#ff7600";
