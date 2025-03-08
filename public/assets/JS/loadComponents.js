export default function loadComponent(id, file) {
    return fetch(file)
        .then(response => response.text())
        .then(html => {
            const container = document.getElementById(id);
            container.innerHTML = html;

            // Execute any scripts inside the loaded content
            container.querySelectorAll("script").forEach(oldScript => {
                const newScript = document.createElement("script");
                if (oldScript.src) {
                    newScript.src = oldScript.src;
                    newScript.async = true;
                } else {
                    newScript.textContent = oldScript.textContent;
                }
                oldScript.parentNode.replaceChild(newScript, oldScript);
            });
        });
}
