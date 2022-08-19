<script>
    function logError(error) {
        try {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "http://domain.test/api/a2918bf3b6d6867d96385add0a8cc5042f35a4e6/errors", true);
            xhttp.setRequestHeader("Content-Type", "application/json");
            let body = JSON.parse(JSON.stringify(error, Object.getOwnPropertyNames(error)));
            var data = {
                'errorlanguage': 'javascript',
                'errorMessage': error.message,
                'errorCode': 0,
                'errorFile': error.fileName,
                'errorLine': error.lineNumber,
                'errorTrace': error.stack,
                'systems_domain': window.location.origin,
            };
            xhttp.send(JSON.stringify(data));
        } catch (error) {

        }
    }
    window.onerror = function(msg, url, line, columnNo, error) {
        logError(error)
    };

    window.addEventListener('unhandledrejection', function(event) {
        logError(event.reason)
    });

    function c() {
        b()
    }

    function b() {
        fj()
    }
    c()
</script>