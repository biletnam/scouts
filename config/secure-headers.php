<?php

$protocol = 'https://';
if (! isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off') {
	$protocol = 'http://';
}

return [

    /*
     * X-Content-Type-Options
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Content-Type-Options
     *
     * Available Value: 'nosniff'
     */

    'x-content-type-options' => 'nosniff',

    /*
     * X-Download-Options
     *
     * Reference: https://msdn.microsoft.com/en-us/library/jj542450(v=vs.85).aspx
     *
     * Available Value: 'noopen'
     */

    'x-download-options' => 'noopen',

    /*
     * X-Frame-Options
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Frame-Options
     *
     * Available Value: 'deny', 'sameorigin', 'allow-from <uri>'
     */

    'x-frame-options' => 'sameorigin',

    /*
     * X-Permitted-Cross-Domain-Policies
     *
     * Reference: https://www.adobe.com/devnet/adobe-media-server/articles/cross-domain-xml-for-streaming.html
     *
     * Available Value: 'all', 'none', 'master-only', 'by-content-type', 'by-ftp-filename'
     */

    'x-permitted-cross-domain-policies' => 'none',

    /*
     * X-XSS-Protection
     *
     * Reference: https://blogs.msdn.microsoft.com/ieinternals/2011/01/31/controlling-the-xss-filter
     *
     * Available Value: '1', '0', '1; mode=block'
     */

    'x-xss-protection' => '1; mode=block',

    /*
     * Referrer-Policy
     *
     * Reference: https://w3c.github.io/webappsec-referrer-policy
     *
     * Available Value: 'no-referrer', 'no-referrer-when-downgrade', 'origin', 'origin-when-cross-origin',
     *                  'same-origin', 'strict-origin', 'strict-origin-when-cross-origin', 'unsafe-url'
     */

    'referrer-policy' => 'no-referrer',

    /*
     * HTTP Strict Transport Security
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/Security/HTTP_strict_transport_security
     *
     * Please ensure your website had set up ssl/tls before enable hsts.
     */

    'hsts' => [
        'enable' => false,

        'max-age' => 15552000,

        'include-sub-domains' => false,
    ],

    /*
     * Public Key Pinning
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/Security/Public_Key_Pinning
     *
     * hpkp will be ignored if hashes is empty.
     */

    'hpkp' => [
        'hashes' => [
            // [
            //     'algo' => 'sha256',
            //     'hash' => 'hash-value',
            // ],
        ],

        'include-sub-domains' => false,

        'max-age' => 15552000,

        'report-only' => false,

        'report-uri' => null,
    ],

    /*
     * Content Security Policy
     *
     * Reference: https://developer.mozilla.org/en-US/docs/Web/Security/CSP
     *
     * csp will be ignored if custom-csp is not null. To disable csp, set custom-csp to empty string.
     *
     * Note: custom-csp does not support report-only.
     */

    'custom-csp' => null,

    'csp' => [
        'report-only' => true,

        'report-uri' => env('CONTENT_SECURITY_POLICY_REPORT_URI', false),

        'upgrade-insecure-requests' => false,

        // enable or disable the automatic conversion of sources to https
        'https-transform-on-https-connections' => true,

        /*'default-src' => [
            //
        ],*/

        'child-src' => [
            //
        ],

        'script-src' => [
            'allow' => [
				$protocol.'*.googleapis.com',
	            $protocol.'cdn.ckeditor.com',
	            $protocol.'cdnjs.cloudflare.com',
            ],

            'hashes' => [
                // ['sha256' => 'hash-value'],
            ],

            'nonces' => [
				'primary' => base64_encode(str_random(128)),
            ],

            'self' => true,

            'unsafe-inline' => false,

            'unsafe-eval' => true,
        ],

        'style-src' => [
            'allow' => [
                $protocol.'*.bootstrapcdn.com',
                $protocol.'cdnjs.cloudflare.com',
                $protocol.'fonts.googleapis.com',
	            $protocol.'*.fbcdn.net'
            ],

            'self' => true,

            'unsafe-inline' => true,
        ],

        /*'img-src' => [
            'allow' => [
            	$protocol.'*.gstatic.com',
            	$protocol.'*.hopper.be'
            ],

            'types' => [
                'jpg', 'png', 'gif', 'svg'
            ],

            'self' => true,

            'data' => true,
        ],*/

        /*
         * The following directives all use 'allow' and 'self' flag.
         *
         * Note: default value of 'self' flag is false.
         */

        'font-src' => [
        	'allow' => [
		        $protocol.'*.gstatic.com',
		        $protocol.'*.bootstrapcdn.com'
	        ]
        ],

        'connect-src' => [
            //
        ],

        'form-action' => [
            'self'
        ],

        'frame-ancestors' => [
            //
        ],

        'media-src' => [
            //
        ],

        'object-src' => [
            //
        ],

        /*
         * plugin-types only support 'allow'.
         */

        'plugin-types' => [
            //
        ],
    ],

];
