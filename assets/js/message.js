// Remove Url
// function removeUrl(key, sourceURL) {
//     var rtn = sourceURL.split('?')[0],
//         param,
//         params_arr = [],
//         queryString = (sourceURL.indexOf("?") != -1) ? sourceURL.split("?")[1] : "";
//     if (queryString != "") {
//         params_arr = queryString.split("&");
//         for (var i = params_arr.length - 1; i >= 0; i -= 1) {
//             param = params_arr[i].split('=')[0];
//             if (param === key) {
//                 params_arr.splice(i, 1);
//             }
//         }
//         rtn = rtn + "?" + params_arr.join("&");
//     }
//     return rtn;
// }
// var url = window.location.href;
// var del = removeUrl("message", url);
// console.log(del);
// Get Url
function getUrlVars(param = null) {
    if (param != null) {
        var vars = [],
            hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars[param];
    } else {
        return null;
    }
}

var message = getUrlVars("message");
switch (message) {
    case 'add':
        Swal.fire({
            icon: 'success',
            title: 'success!',
            text: 'Data berhasil di tambahkan!',
        });
        break;

    case "edit":
        Swal.fire({
            icon: 'success',
            title: 'success!',
            text: 'Data berhasil di edit!',
        });
        break;

    case "delete":
        Swal.fire({
            icon: 'success',
            title: 'success!',
            text: 'Data berhasil di hapus!',
        });
        break;

    case "tanggapan":
        Swal.fire({
            icon: 'success',
            title: 'success!',
            text: 'Data berhasil di tanggapi!',
        });
        break;

    case "verif":
        Swal.fire({
            icon: 'success',
            title: 'success!',
            text: 'Data berhasil di konfirmasi!',
        });
        break;

    default:
        break;
}

$('body').on('click', '.btn-delete', function (event) {
    event.preventDefault();

    var url = $(this).attr('href');

    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Hapus data ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.value) {
            window.location.href = url;
        }
    });
});