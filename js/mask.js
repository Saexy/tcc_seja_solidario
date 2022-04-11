var maskCel = function (o) {
    setTimeout(function() {
        var v = o.value.replace(/\D/g, "");
        v = v.replace(/^0/, "");
        if (v.length > 10) {
            v = v.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (v.length > 5) {
            v = v.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        } else if (v.length > 2) {
            v = v.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
        } else {
            v = v.replace(/^(\d*)/, "($1");
        }
        if (v != o.value) {
            o.value = v;
        }
    }, 1);
}