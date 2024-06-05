export const copyCurrentUrl = () => {
    const url = window.location.href;
    console.log(url)

    navigator.permissions.query().then((result) => {
        if (result.state === "granted" || result.state === "prompt") {
            alert("Write access ranted!");
        }
    });

    navigator.clipboard.writeText(url.value).then(() => {
        alert(url + " Copied to clipboard");
    });
}