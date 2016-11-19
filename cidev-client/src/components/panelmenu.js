if(!xtag.tags['cd-panelmenu']) {
    xtag.register('cd-panelmenu', {
        lifecycle: {
            created: function() {
                var element = $(this);
                this.xtag.container = $('<div></div>').appendTo(this);

                $(this.xtag.container).puipanelmenu();
            }
        }
    });
}