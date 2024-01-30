/** @type {import('vite').UserConfig} */
export default {
    build: {
        assetsDir: "",
        rollupOptions: {
            input: ["resources/js/app.js","resources/css/app.css"],
            output: {
                assetFileNames: "[name][extname]",
                entryFileNames: "[name].js",
            },
        },
    },
};