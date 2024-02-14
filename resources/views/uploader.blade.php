<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="./css/app.css" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center pb-10">
                    <img src="/images/wemod.png" />
                </div>

                <form onsubmit="return uploadFile(this)" action="javascript:void(0);">
                    <div>
                        <input class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                        <button type="submit" class="disabled:bg-blue-300 w-full mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="recent" class="w-full grid col-4 p-5" style="border-top:20px solid cornflowerblue">
            <div class="w-full px-4 mx-auto max-w-8xl">
                <h3 style="text-align: center;font-size: 1.7rem;font-weight: 600;color: #333;" class="text-lg-center block">Recently Added Short Codes</h3>
                <div class="flex" style="justify-content: center;align-items: center;">
                    <div id="loading" class="hidden pt-5">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div id="content" class="hidden relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Short Code
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Link
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full p-5 hidden" id="details-wrapper">
            <div class="w-full px-4 mx-auto max-w-8xl">
                <div class="flex" style="justify-content: center;align-items: center;">
                    <div id="details-loading" class="hidden pt-5">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div id="details">
                        <h3>Details</h3>
                        <div id="code-details" class="pb-5">

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        <script>
            onload = (event) => {
                fetchRecent();
            };

            function detailsLoading()
            {
                document.getElementById('details').style.display = 'none';
                document.getElementById('details-wrapper').style.display = 'block';
                document.getElementById('details-loading').style.display = 'block';
            }

            function detailsDoneLoading()
            {
                document.getElementById('details').style.display = 'block';
                document.getElementById('details-wrapper').style.display = 'block';
                document.getElementById('details-loading').style.display = 'none';
            }

            function showSpinner()
            {
                document.getElementById('content').style.display = 'none';
                document.getElementById('loading').style.display = 'block';
            }

            function hideSpinner()
            {
                document.getElementById('content').style.display = 'block';
                document.getElementById('loading').style.display = 'none';
            }

            async function callApi(endpoint, method, params, isFileUpload) {
                let headers = {
                    "X-Requested-With": "XMLHttpRequest"
                }
                if (!isFileUpload) {
                    headers['Content-Type'] = 'application/json';
                }
                let opts = {
                    method: method,
                    headers: headers,
                }
                if (method.toLowerCase() === 'post') {
                    opts['body'] = params;
                }
                const fetched = await fetch(endpoint, opts);
                return await fetched.json()
            }

            async function detailsClicked(element)
            {
                detailsLoading();
                const wrapper = document.getElementById('details-wrapper');
                wrapper.scrollIntoView();
                const id = element.dataset.rowId;
                const details = await callApi('/api/v1/short-codes/' + id, 'get');
                const append = '<label class="block">' +
                    'Short Code:' + details.short_code.short_code + '</label>' +
                    '<label class="block">Num Visits: ' + details.short_code.num_visits + '</label>'
                const detailsInfoEl = document.getElementById('code-details');
                detailsInfoEl.innerHTML = append;
                detailsDoneLoading();
                detailsInfoEl.scrollIntoView(true);
            }

            async function fetchRecent() {
                showSpinner();
                const recent = await callApi('/api/v1/short-codes/recent?limit=50', 'get');
                const element = document.getElementById('content').querySelector('tbody');
                let append = '';
                if (recent.short_codes?.length === 0) {
                    append = '<td colspan="4">No shortcodes created yet</td>'
                }
                for (let i=0; i<recent.short_codes?.length;i++) {
                    let row = recent.short_codes[i];
                    append += '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">' +
                        '<td class="px-6 py-2">' + row.id + '</td>' +
                        '<td class="px-6 py-2">' + '<a href="' + row.short_code_url + '" target="_blank">' + row.short_code_url + '</a></td>' +
                        '<td class="px-6 py-2">' + '<a href="' + row.url + '" target="_blank">' + truncateText(row.url, 50) + '</a></td>' +
                        '<td class="px-6 py-2">' + row.created_at + '</td>' +
                        '<td class="px-6 py-2"><a href="javascript:void(0);" onclick="detailsClicked(this)" data-row-id="' + row.id + '">See Details</a></td>' +
                        '</tr>';
                }

                element.innerHTML = append;

                hideSpinner();
            }

            async function uploadFile(formEl) {
                let button = formEl.querySelector('button');
                button.disabled = true;
                let formData = new FormData();
                formData.append("file", document.getElementById('file_input').files[0]);
                const response = await callApi('/api/v1/urls/upload', 'POST', formData, true);
                alert(response.message);
                button.disabled = false;
                await fetchRecent();
                return false;
            }

            function truncateText(text, length) {
                if (text.length <= length) {
                    return text;
                }

                return text.substring(0, length) + '\u2026'
            }
        </script>
    </body>
</html>
