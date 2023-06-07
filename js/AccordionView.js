class AccordionView {
    constructor(elementId) {
        this.elementId = elementId;
    }

    appendItem(itemData) {
        $(this.elementId).append(
            `<div class='accordion-item'> 
                <h2 class='accordion-header'> 
                    <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse${itemData.index}' 
                    aria-expanded='false' aria-controls='collapse${itemData.index}'>${itemData.productType}</button> 
                </h2> 
                <div id='collapse${itemData.index}' class='accordion-collapse collapse' data-bs-parent='${this.elementId}'> 
                <div class='accordion-body'>${itemData.productHTML}</div> 
                </div> 
            </div>`);
    }

    //This function is responsible for fetching the data and creating the accordion.

    fetchDataAndCreateAccordion(dataFetcher) {
        dataFetcher.fetchData((dataList) => {
            dataList.forEach((value, index) => {
                this.fetchProductDataAndAppendItem({productType: value.productType, index: index, url: value.url});
            });
        });
    }

// This function is responsible for fetching product data and appending the item to the accordion.

    fetchProductDataAndAppendItem(itemData) {
        let productDataFetcher = new DataFetcher(itemData.url);
        productDataFetcher.fetchData((productData) => {
            this.createProductHtmlAndAppendItem({
                productType: itemData.productType,
                index: itemData.index,
                productData: productData
            });
        });
    }

 //   This function is responsible for creating the product HTML and appending the item to the accordion.

    createProductHtmlAndAppendItem(itemData) {
        let productHTML = itemData.productData[1].products.map(product => `<div class="d-flex justify-content-between my-3"><p>${product.name}</p><button class="btn btn-primary select-product">Select</button></div>`).join("");
        this.appendItem({productType: itemData.productType, index: itemData.index, productHTML: productHTML});
    }
}
