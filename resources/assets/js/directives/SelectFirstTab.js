module.exports = {
    inserted: function(el){
            $(el).find('a:first').tab('show');
        }
}