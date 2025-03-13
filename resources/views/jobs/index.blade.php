<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Open Positions</title>
    <link rel="stylesheet" href="{{ asset('assets_open_pos/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/CSS/style.css') }}" />
    <link href="https://fonts.cdnfonts.com/css/open-sauce-one" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet" />
</head>

<body>
    <div id="header"></div>

    <main>
        <h1>Open Positions</h1>
        <!-- Open Positions Section -->
        <section id="open-positions" class="positions">
            <div class="blur-overlay"></div>
            <!-- Transparent Overlay -->
            <div class="open-positions">
                <!-- Director Position -->
                <a href="position.html" class="new-tab no-underline">
                    <div class="img-client">
                        <img src="./assets/images/client-1.png" alt="Director" class="new-tab-image" />
                    </div>
                    <div class="new-tab-text">
                        <h2>Director</h2>
                        <p>
                            10+ years of experience in leading teams,<br />
                            Knowledge of MS Tools,<br />
                            Proficiency in English/Italian/French/German
                        </p>
                    </div>
                </a>
                <!-- Marketing Position -->
                <a href="position.html" class="new-tab no-underline">
                    <div class="img-client">
                        <img src="./assets/images/client-2.png" alt="Marketing" class="new-tab-image" />
                    </div>
                    <div class="new-tab-text">
                        <h2>Marketing</h2>
                        <p>
                            5+ years of experience in digital marketing,<br />
                            Proven track record in campaigns,<br />
                            Fluent in English
                        </p>
                    </div>
                </a>
                <!-- Developer Position -->
                <a href="position.html" class="new-tab no-underline">
                    <div class="img-client">
                        <img src="./assets/images/client-3.png" alt="Developer" class="new-tab-image" />
                    </div>
                    <div class="new-tab-text">
                        <h2>Developer</h2>
                        <p>
                            5+ years of experience in development,<br />
                            Proven knowledge of design,<br />
                            Fluent in English
                        </p>
                    </div>
                </a>
            </div>
            <div class="overlay-content">
                <h2>
                    Currently, there are no open positions.<br />For spontaneous
                    applications, please send your CV along with a brief description of
                    the desired position.
                </h2>
                <a href="404.html" id="uploadCvBtn">Upload CV</a>
            </div>
        </section>
    </main>
    <!-- /*---------- footer ------------ */ -->
    <div id="footer"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            async function loadComponent(id, file) {
                try {
                    console.log(`Loading ${file} into #${id}`); // Debugging log
                    const response = await fetch(file);
                    if (!response.ok)
                        throw new Error(
                            `Error loading ${file}: ${response.status} ${response.statusText}`
                        );

                    const content = await response.text();
                    document.getElementById(id).innerHTML = content;
                    console.log(`Loaded ${file} successfully`); // Debugging log
                } catch (error) {
                    console.error(error);
                }
            }

            // Fix the paths based on your folder structure
            loadComponent("header", "header.html");
            loadComponent("footer", "footer.html");
        });
    </script>
    <!--
    <script src="./assets/JS/main.js"></script>
    <script src="./assets_open_pos/js/main.js"></script> -->
</body>

</html>
