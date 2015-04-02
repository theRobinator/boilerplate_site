robin.Main = function() {
    // Show the config in a div
    document.getElementById('config').innerHTML = JSON.stringify(robin.Config);

    // Expose the ability to make API calls
    callTheAPI = function() {
        robin.Api.returnRandomString().setCallback(function(result) {
            document.getElementById('api-result').innerHTML = result;
        });
    };
};
