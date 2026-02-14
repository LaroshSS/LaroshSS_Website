<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valentine's Date Responses</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --pink-light: #FFE5E5;
            --pink-medium: #FFB6C1;
            --pink-dark: #FF69B4;
            --red-accent: #FF1744;
            --text-dark: #4A154B;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, #FFE5E5 0%, #FFC4D6 50%, #FFB6C1 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            font-family: 'Pacifico', cursive;
            color: var(--red-accent);
            font-size: 2.5em;
            text-align: center;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(255, 105, 180, 0.2);
        }

        .response-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(255, 105, 180, 0.2);
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .response-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--pink-light);
        }

        .response-number {
            font-family: 'Pacifico', cursive;
            color: var(--red-accent);
            font-size: 1.5em;
        }

        .response-timestamp {
            color: var(--pink-dark);
            font-size: 0.9em;
        }

        .response-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .detail-item {
            background: var(--pink-light);
            padding: 15px;
            border-radius: 12px;
            border-left: 4px solid var(--pink-dark);
        }

        .detail-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            color: var(--red-accent);
            font-size: 1.1em;
            font-weight: 600;
        }

        .no-responses {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 60px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(255, 105, 180, 0.2);
        }

        .no-responses h2 {
            font-family: 'Pacifico', cursive;
            color: var(--pink-dark);
            font-size: 2em;
            margin-bottom: 15px;
        }

        .no-responses p {
            color: var(--text-dark);
            font-size: 1.2em;
        }

        .refresh-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, var(--red-accent), var(--pink-dark));
            color: var(--white);
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 1.5em;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(255, 23, 68, 0.4);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .refresh-btn:hover {
            transform: scale(1.1) rotate(180deg);
            box-shadow: 0 6px 25px rgba(255, 23, 68, 0.6);
        }

        @media (max-width: 768px) {
            .response-details {
                grid-template-columns: 1fr;
            }

            .response-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Valentine's Date Responses ♡</h1>
        <div id="responsesContainer"></div>
    </div>

    <button class="refresh-btn" onclick="loadResponses()" title="Refresh">⟳</button>

    <script>
        async function loadResponses() {
            try {
                const response = await fetch('responses.json');
                
                if (!response.ok) {
                    throw new Error('No responses yet');
                }
                
                const data = await response.json();
                const container = document.getElementById('responsesContainer');
                
                if (!data || data.length === 0) {
                    container.innerHTML = `
                        <div class="no-responses">
                            <h2>No responses yet</h2>
                            <p>Waiting for Fani to make her choices...</p>
                        </div>
                    `;
                    return;
                }
                
                // Display responses in reverse order (newest first)
                container.innerHTML = data.reverse().map((resp, index) => `
                    <div class="response-card">
                        <div class="response-header">
                            <div class="response-number">Response #${data.length - index}</div>
                            <div class="response-timestamp">${resp.timestamp || 'Unknown time'}</div>
                        </div>
                        <div class="response-details">
                            <div class="detail-item">
                                <div class="detail-label">Time</div>
                                <div class="detail-value">${resp.time || 'Not selected'}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Dress Code</div>
                                <div class="detail-value">${resp.dress || 'Not selected'}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">Movie</div>
                                <div class="detail-value">${resp.movie || 'Not selected'}</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-label">WoW Mounts</div>
                                <div class="detail-value">${resp.wow || 'Not selected'}</div>
                            </div>
                        </div>
                    </div>
                `).join('');
                
            } catch (error) {
                const container = document.getElementById('responsesContainer');
                container.innerHTML = `
                    <div class="no-responses">
                        <h2>No responses yet</h2>
                        <p>Waiting for Fani to make her choices...</p>
                    </div>
                `;
            }
        }

        // Load responses on page load
        loadResponses();

        // Auto-refresh every 10 seconds
        setInterval(loadResponses, 10000);
    </script>
</body>
</html>
