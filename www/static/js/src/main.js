goog.provide('robin.Main');
goog.provide('robin.Config');
goog.provide('robin.Api');


robin.Main = function(globalConfig, api) {
    // Store the config and API in globals
    robin.Config = globalConfig;
    robin.Api = api;

    // Show the config in a div
    document.getElementById('config').innerHTML = JSON.stringify(robin.Config);

    // Expose the ability to make API calls
    callTheAPI = function() {
        robin.Api.returnRandomString().setCallback(function(result) {
            document.getElementById('api-result').innerHTML = result;
        });
    };
};
