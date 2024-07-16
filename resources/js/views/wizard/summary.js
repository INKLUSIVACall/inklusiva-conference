function prepareUserdataDownloadLink(userdata) {
    var data = JSON.stringify(userdata);
    var blob = new Blob([data], {
        type: "text/plain;charset=utf-8"
    });
    var url = URL.createObjectURL(blob);
    var a = document.getElementById("userdataDownloadLink");
    a.href = url;
    a.download = "InklusivaCall.json";
    // URL.revokeObjectURL(url); // Clean up the temporary URL
}
window.prepareUserdataDownloadLink = prepareUserdataDownloadLink;

function initSummary(json) {
    prepareUserdataDownloadLink(json);

    //On submit, save the settings in the local storage, if saveSettings is true
    document.getElementById("stepForm").addEventListener("submit", function() {
        // if the saveSettings checkbox exists, save only if it is checked, otherwise save anyway.
        if(document.getElementById("saveSettings")) {
            if (document.getElementById("saveSettings").checked) {
                localStorage.setItem("userData", JSON.stringify(json));
            }
        }
        else {
            localStorage.setItem("userData", JSON.stringify(json));
        }

        var tempUrl = document.getElementById("userdataDownloadLink").href;
        URL.revokeObjectURL(tempUrl);
    });
}
window.initSummary = initSummary;
