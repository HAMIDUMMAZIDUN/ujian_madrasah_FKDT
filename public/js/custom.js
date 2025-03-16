$(document).ready(function() {
    $("#kecamatan").change(function() {
        $.ajax({
            url: "/get-desa",
            type: "GET",
            data: { kecamatan: $("#kecamatan").val() },
            success: function(response) {
                let desaSelect = $("#desa");
                desaSelect.empty();
                desaSelect.append('<option value="">Pilih Desa</option>'); 
                response.forEach(function(desa) {
                    desaSelect.append('<option value="'+ desa +'">'+ desa +'</option>');
                });
            },
            error: function(xhr) {
                alert("Terjadi kesalahan saat mengambil data desa.");
            }
        });
    });
});
