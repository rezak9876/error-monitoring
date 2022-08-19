<script>
    function logError(error) {
        try {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "http://domain.test/api/a2d7ac110a59d70ddf41459184efd812046a59fe/errors", true);
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