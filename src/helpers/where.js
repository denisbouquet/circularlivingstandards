module.exports = function(key, val, arr) {
  var i, item;
  var len = arr.length;
  for( i = 0; i < len; i++) {
    item = arr[i];
    if( item[key] === val ) {
      return item;
    }
  }
  return {};
}
