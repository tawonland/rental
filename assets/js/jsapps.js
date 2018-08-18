function hitungInvoice() {
    var dpp = parseInt($("#dpp").val());
    var ppn = parseInt($("#ppn").val());
    var pph = parseInt($("#pph").val());
    var total = dpp + ppn + pph;
    $("#invoice").val(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
}

function sumQty(){
    var unitprice = parseInt($("#unitprice").val());
    var qty = parseInt($("#qty").val());
    var subtotal = unitprice * qty;
    $("#subtotal").val(subtotal.toString());
}

function masuk(txt, data) {

    var material = data.split('-');

    document.getElementById('material').value = material[0];
    document.getElementById('uraian').value = material[1];
    var unitprice = parseInt(material[2]);
    //document.getElementById('unitprice').value = unitprice.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    document.getElementById('unitprice').value = unitprice;
    document.getElementById('uom').value = material[3];
    $("#basic").modal('hide');
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
 return true;
}

function AddDay(strDate,intNum)
{
    sdate =  new Date(strDate);
    sdate.setDate(sdate.getDate()+intNum);
    return sdate.getMonth()+1 + "-" + sdate.getDate() + "-" + sdate.getFullYear();
}

function AddMonth(strDate,intNum)
{
    sdate =  new Date(strDate);
    sdate.setMonth(sdate.getMonth()+intNum);
    return sdate.getMonth()+1 + "-" + sdate.getDate() + "-" + sdate.getFullYear();
}

function AddYear(strDate,intNum)
{
    sdate =  new Date(strDate);
    sdate.setFullYear(sdate.getFullYear()+intNum);
    return sdate.getMonth()+1 + "-" + sdate.getDate() + "-" + sdate.getFullYear();
}

function getdate()
{
    var durasi = document.getElementById('durasi').value;
    var start = document.getElementById('tglmulai').value;
    var parts = start.split('-');
    
    var sdate = new Date(parts[0], parts[1], parts[2]);
    sdate.setMonth(sdate.getMonth()+parseInt(durasi));

    var hasil = sdate.getFullYear()+"-"+(sdate.getMonth() < 10 ? '0' + sdate.getMonth() : sdate.getMonth())+"-"+(sdate.getDate() < 10 ? '0' + sdate.getDate() : sdate.getDate());
    document.getElementById('tglselesai').value = hasil;
}

function terbilang(){
    var bilangan= $("#nominal").val();
    var kalimat="";
    var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
    var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
    var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');
    var panjang_bilangan = bilangan.length;
     
    /* pengujian panjang bilangan */
    if(panjang_bilangan > 15){
        kalimat = "Diluar Batas";
    }else{
        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
        for(i = 1; i <= panjang_bilangan; i++) {
            angka[i] = bilangan.substr(-(i),1);
        }
         
        var i = 1;
        var j = 0;
         
        /* mulai proses iterasi terhadap array angka */
        while(i <= panjang_bilangan){
            subkalimat = "";
            kata1 = "";
            kata2 = "";
            kata3 = "";
             
            /* untuk Ratusan */
            if(angka[i+2] != "0"){
                if(angka[i+2] == "1"){
                    kata1 = "Seratus";
                }else{
                    kata1 = kata[angka[i+2]] + " Ratus";
                }
            }
             
            /* untuk Puluhan atau Belasan */
            if(angka[i+1] != "0"){
                if(angka[i+1] == "1"){
                    if(angka[i] == "0"){
                        kata2 = "Sepuluh";
                    }else if(angka[i] == "1"){
                        kata2 = "Sebelas";
                    }else{
                        kata2 = kata[angka[i]] + " Belas";
                    }
                }else{
                    kata2 = kata[angka[i+1]] + " Puluh";
                }
            }
             
            /* untuk Satuan */
            if (angka[i] != "0"){
                if (angka[i+1] != "1"){
                    kata3 = kata[angka[i]];
                }
            }
             
            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
            if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
                subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
            }
             
            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
            kalimat = subkalimat + kalimat;
            i = i + 3;
            j = j + 1;
        }
         
        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
        if ((angka[5] == "0") && (angka[6] == "0")){
            kalimat = kalimat.replace("Satu Ribu","Seribu");
        }
    }
    document.getElementById("terbilang").innerHTML="<em>"+kalimat+" Rupiah</em>";
}