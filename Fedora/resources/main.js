/* JavaScript for the Example skin */
$( document ).ready(function() {
    $("#wpSave").addClass("btn btn-primary");
    $("#wpPreview").addClass("btn btn-secondary");
    $("#wpDiff").addClass("btn btn-secondary");
    $("#wpTextbox1").addClass("form-control");
    $("#wpSummary").addClass("form-control");
    mw.loader.load( 'https://apps.fedoraproject.org/global/fedora-bootstrap-1.0.1/fedora-bootstrap.js' );

    // https://pagure.io/fedora-infrastructure/issue/6912
    $('.mw-headline').each(
      function(f) {
        $(this).prepend(
          '<a href="#' + $(this).attr('id') + '">' + String.fromCodePoint(128279) + '</a> '
        );
      }
    );
});
