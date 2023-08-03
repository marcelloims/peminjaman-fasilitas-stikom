let flashData = $("#flash-data").data("flashdata");
let title = $("#title").data("flashdata");
console.log(flashData, title);

if (flashData) {
    Swal({
        title: "Data " + title,
        text: flashData,
        type: "success",
    });
}

$(".button-delete").on("click", function (e) {
    e.preventDefault();
    const href = $(this).attr("href");

    Swal({
        title: "Anda yakin untuk hapus ?",
        text: "Kamu tidak akan bisa mengembalikan data ini lagi!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, hapus data ini!",
        cancelButtonText: "Batalkan!",
        closeOnConfirm: !1,
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});
