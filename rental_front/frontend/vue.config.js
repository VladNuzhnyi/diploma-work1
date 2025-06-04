module.exports = {
    lintOnSave: false,
    configureWebpack: {
        module: {
            rules: [
                {
                    test: /\.less$/,
                    use: [
                        'vue-style-loader',
                        'css-loader',
                        'less-loader'
                    ]
                }
            ],
        }
    },

    // options...
    devServer: {
        port: 8081,
        disableHostCheck: true
    },
    pages:{
        index: {
            // entry for the page
            entry: 'src/index/main.js',
            // the source template
            template: 'public/index.html',
            // output as dist/index.html
            filename: 'index.html',
            // when using title option,
            // template title tag needs to be <title><%= htmlWebpackPlugin.options.title %></title>
            title: 'Index Page',
            // chunks to include on this page, by default includes
            // extracted common chunks and vendor chunks.
            chunks: ['chunk-vendors', 'chunk-common', 'index']
        },
        authorize: "src/authorize/main.js",
    }
};
