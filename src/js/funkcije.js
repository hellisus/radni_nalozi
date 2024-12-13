function to_hp() {
  event.preventDefault();
  window.location.href = '../index.php';
}

function to_main() {
  event.preventDefault();
  window.location.href = '../php/glavni.php';
}

function snimi_zakazivanje(nalog) {

  //Kreiraj id odakle uzimaš podatke putem promenjive koja proslađuje id naloga

  var datum = "#datum_zakazan_" + nalog;
  var vreme = "#vreme_zakazan_" + nalog;
  var zaduzen_na = "#kome_zaduzen_" + nalog;
  var status_na = "#status_id_" + nalog;
  var napomena = "#napomena_id_" + nalog;

  var DatumVrednost = $(datum).val();
  var VremeVrednost = $(vreme).val();
  var ZaduzenNaVrednost = $(zaduzen_na).val();
  var Status = $(status_na).val();
  var Napomena = $(napomena).val();

  var DatumVrednostsqlelementi = DatumVrednost.split("/");
  var DatumVrednostsql = DatumVrednostsqlelementi[2] + "-" + DatumVrednostsqlelementi[0] + "-" + DatumVrednostsqlelementi[1];


  console.log("NALOG ID : " + nalog);
  console.log(DatumVrednost);
  console.log(DatumVrednostsql);
  console.log(VremeVrednost);
  console.log(ZaduzenNaVrednost);
  console.log(Status);
  console.log(Napomena);

  $.ajax({
    type: "POST",
    url: 'zakazivanje_upis.php',
    data: { 'nalog': nalog, 'DatumVrednost': DatumVrednostsql, 'VremeVrednost': VremeVrednost, 'ZaduzenNaVrednost': ZaduzenNaVrednost, 'Status': Status, 'Napomena': Napomena },
    success: function () {
    },
    error: function () {
    }

  }).done(function (html) {
    $("#rez").html(html);
    location.reload();
  });
}

function snimi_izmene(nalog) {


  var TipNaloga = $('#tip_naloga').val();
  var Direkcija = $('#direkcija').val();
  var Adresa = $('#adresa').val();
  var Region = $('#region').val();

  var DatumVrednost = $("#datum_zakazan").val();
  var VremeVrednost = $("#vreme_zakazan").val();

  var ZaduzenNaVrednost = $("#kome_zaduzen").val();
  var Status = $("#status_id").val();

  var Napomena = $('#napomena').val();


  var DatumVrednostsqlelementi = DatumVrednost.split("/");
  var DatumVrednostsql = DatumVrednostsqlelementi[2] + "-" + DatumVrednostsqlelementi[0] + "-" + DatumVrednostsqlelementi[1];


  console.log("NALOG ID : " + nalog);
  console.log(DatumVrednost);
  console.log(DatumVrednostsql);
  console.log(VremeVrednost);
  console.log(ZaduzenNaVrednost);
  console.log(Status);
  console.log(TipNaloga);
  console.log(Direkcija);
  console.log(Adresa);
  console.log(Region);
  console.log(Napomena);


  $.ajax({
    type: "POST",
    url: 'izmena_upis.php',
    data: {
      'nalog': nalog,
      'DatumVrednost': DatumVrednostsql,
      'VremeVrednost': VremeVrednost,
      'ZaduzenNaVrednost': ZaduzenNaVrednost,
      'Status': Status,
      'TipNaloga': TipNaloga,
      'Direkcija': Direkcija,
      'Adresa': Adresa,
      'Region': Region,
      'Napomena': Napomena,
    },
    success: function () {
    },
    error: function () {
    }

  }).done(function (html) {
    $("#rez").html(html);
    location.reload();
  });
}





function pretrazi_adresu() {


  var Adresa = $('#pretraga_adresa').val();
  console.log(Adresa);
  window.location.href = '../php/adresa_pretraga.php?pojam=' + Adresa;


}

function pretrazi_gotove() {


  var Datum_od = $('#datum_od').val();
  var Datum_do = $('#datum_do').val();

  var Datum_od_el = Datum_od.split("/");
  Datum_od = Datum_od_el[2] + "-" + Datum_od_el[0] + "-" + Datum_od_el[1];

  var Datum_do_el = Datum_do.split("/");
  Datum_do = Datum_do_el[2] + "-" + Datum_do_el[0] + "-" + Datum_do_el[1];

  console.log(Datum_od);
  console.log(Datum_do);
  window.location.href = '../php/gotovi_pretraga.php?od=' + Datum_od + "&do=" + Datum_do;


}

function tableToExcel(p) {

  var dlink = document.createElement('a');

  document.body.appendChild(dlink);

  var uri = 'data:application/vnd.ms-excel;base64,';

  var template =

    '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"></head><body><table>{table}</table></body></html>';

  var base64 = function (s) {

    return window.btoa(unescape(encodeURIComponent(s)));

  };

  var format = function (s, c) {

    return s.replace(/{(\w+)}/g, function (m, p) {

      return c[p];

    });

  };

  if (!p.table.nodeType) p.table = document.getElementById(p.table);

  var ctx = { worksheet: p.worksheet || 'Worksheet', table: p.table.innerHTML };

  dlink.href = uri + base64(format(template, ctx));

  dlink.download = p.filename;

  dlink.click();

  document.body.removeChild(dlink);

}

function stampaj_nalog(id) {
  window.location.href = '../php/izvestaj_print.php?id=' + id;
}