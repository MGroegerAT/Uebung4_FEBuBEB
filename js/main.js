$(document).ready(function () {
    let accordion = new AccordionView("#accordionExample");
    let dataFetcher = new DataFetcher("http://localhost/uebung4/api/index.php?action=listTypes");

    accordion.fetchDataAndCreateAccordion(dataFetcher);

    $(document).on('click', '.select-product', function () {
        alert($(this).prev().text());
    });
})
;

