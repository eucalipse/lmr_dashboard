$("body").on("click", ".lngBar span", function (e) {
  e.preventDefault()
  const lng = $(this).attr("lng")
  const url = new URL(window.location.href)

  if (lng === "en") {
    url.searchParams.set("lang", "en")
  } else {
    url.searchParams.delete("lang")
  }

  window.location.href = url.toString()
})
