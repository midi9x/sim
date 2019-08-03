jQuery(document).ready(function($) {
    $("#form-loc-sim").submit(function() {
        $(this).find(":input").filter(function(){ return !this.value; }).attr("disabled", "disabled");
        return true;
    });

    $( "#form-loc-sim" ).find( ":input" ).prop( "disabled", false );

    $('#form-tim-sim').on('submit', function(e) {
        e.preventDefault();
        var keyword = this.keyword.value;
        var searchUrl = '/tim-sim/';
        keyword = new String(keyword);
        keyword = keyword.toLowerCase();
        keyword = keyword.replace(/[^0-9^*^x]/g, '');
        keyword = keyword.replace(/\*+/g, '*');
        if (keyword == '') {
            alert("Nhập số sim cần tìm có ít nhất 2 chữ số!");
            this.keyword.focus();
            return false;
        } else {
            window.location.href = searchUrl + keyword;
            return true;
        }
    });

    $('#form-loc-sim select').on('change', function(e) {
        e.preventDefault();
        var gia = $('#gia').val();
        if (gia) {
            gia = gia.split(",");
            var giaTu = gia[0];
            var giaDen = gia[1];
            $("#gia").after('<input type="hidden" name="giaden" value="' + giaDen + '">');
            $("#gia").after('<input type="hidden" name="giatu" value="' + giaTu + '">');
        }
        $('#form-loc-sim').submit();
    });
});