class DataFetcher {
    constructor(url) {
        this.url = url;
    }

    fetchData(response) {
        let self = this;
        $.ajax({
            url: self.url,
            method: "GET"
        })
            .done(response)
            .fail(function (error) { //process error
                console.log("FAIL");
            })
            .always(function () { //will always be called if on error or success
                console.log("ALWAYS");
            });
    }
}
