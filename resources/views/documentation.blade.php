<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TODO list documentation</title>

        <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui.css" />

    </head>

    <body style="background-color: #d5edce; padding: 40px 0;">
        <div class="container"style="width: 100%; max-width: 1200px; margin: 0 auto; border-radius: 40px; overflow: hidden; background: #fff;">
            <h1 style="font-size: 32px; padding: 16px; font-weight: 600;">
                Api Documentation v1
            </h1>
            <div class="swagger" id="docs"></div>
        </div>
        <script src="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui-bundle.js" crossorigin></script>
        <script src="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui-standalone-preset.js" crossorigin></script>

        <script>

            {{--SwaggerUIBundle({--}}
            {{--    url: '{{ route('openapi.v1.yaml') }}',--}}
            {{--    dom_id: '#docs'--}}
            {{--})--}}

                window.onload = () => {
                window.ui = SwaggerUIBundle({
                    url: '{{ route('openapi.v1.yaml') }}',
                    dom_id: '#docs',
                });
            };
        </script>
    </body>
</html>
