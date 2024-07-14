
function wpfw_prod_filter_form_handler(e){


  const currentValue = e.value;

  const filterKey = e.name;

  const searchParams = new URLSearchParams(window.location.search);


  if (currentValue) {
    searchParams.set(filterKey, currentValue);
  } 
  else {
    searchParams.delete(filterKey);
  }

  window.location.search = searchParams.toString();

}
