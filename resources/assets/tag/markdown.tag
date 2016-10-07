<view-markdown>
    <div class="row">
        <div class="col-xs-9">
            <div class="page-content" id="page-content"></div>
        </div>
        <div class="col-xs-3">
            <h3>見出し</h3>
            <div class="page-toc" id="page-toc">{this.toc}</div>
        </div>
    </div>

    this.toc = null;
    this.on('mount', function() {
        var markdownContent = '' + this.opts.body + '\n\n[[toc]]'
        document.getElementById('page-content').innerHTML = md.render(markdownContent)
        this.toc = document.getElementById('page-content').getElementsByClassName('table-of-contents')[0]
        document.getElementById('page-toc').appendChild(this.toc)
    })
</view-markdown>
