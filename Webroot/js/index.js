
/* user */
$(document).on("click", "button.edit", showModalEdit);
$(document).on("click", "button.create", showModalCreate);
$(document).on("click", "div.showForm", showForm);
$(document).on("click", "div.cancel", hideForm);

/* Article */
$(document).on("click", ".button.deleteArticle", showModalDeleteArticle);

/* Search */ 
$("input[type='prompt']").on("keyup", displaySearch);
$('.ui.dropdown').dropdown();


function showModalEdit()
{
		$('#editModal').modal({detachable: false});
		$('#editModal').modal('show');
}

function showModalCreate()
{
		$('#createModal').modal({detachable: false});
		$('#createModal').modal('show');
}

function showModalDeleteArticle()
{
	$('#delArticle').modal({detachable: false});
	$('#delArticle').modal('show');
}

/* Display form to add category or tag*/
function showForm()
{
		$(this).parent().addClass("hidden");
		$(this).parent().removeClass("active");
		$(document).find(".flexContainer.add").addClass("active");
		$(document).find(".flexContainer.add").removeClass("hidden");
}
function hideForm()
{
		$(document).find(".flexContainer.choose").removeClass("hidden");
		$(document).find(".flexContainer.choose").addClass("active");
		$(document).find(".flexContainer.add").removeClass("active");
		$(document).find(".flexContainer.add").addClass("hidden");
}

function displaySearch()
{
	var search = $(this).val().toLowerCase().split(" ");
	var text = $('li.ui.card');

	if (search != "")
	{
		$("li.ui.card").each(function() {

			var result = true;
			var list = $(this);

			var name = list.find('div.username');
			var email = list.find('div.email');
			var date = list.find('div.date');
			search.forEach(function(element) 
			{	
				if ( (!(list.hasClass(element)) && name.text().toLowerCase().search(element) == -1) && ( !(list.hasClass(element)) && email.text().toLowerCase().search(element) == -1) && ( !(list.hasClass(element)) && date.text().toLowerCase().search(element) == -1))
				{
					result = false;
					return false;
				}
			});

			if (result)
			{
				$(this).show();
			}
			else
			{
				$(this).hide();
			}

		});
	}
	else 
	{
		$("body").find("li").show();
	}

}