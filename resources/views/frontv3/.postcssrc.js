// https://github.com/michael-ciniawsky/postcss-load-config

module.exports = {
    "plugins": {
        // to edit target browsers: use "browserslist" field in package.json
        "autoprefixer": {}
    },
    plugins: [
        require('postcss-px2rem-exclude')({
            remUnit: 75,
            exclude: /(node_modules)|(src\\components\\pc)/i
        }),
        require('autoprefixer')({
            browsers: 'ios >= 8'
        })
    ]
}


