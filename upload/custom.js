function addOverlay() {
    $('<div id="overlayDocument"><img src="' + SITE_IMG + 'loading.gif" /></div>').appendTo(document.body);
}
function removeOverlay() {
    $('#overlayDocument').remove();
}

function getStatusText(code)
{
    sText = "";
    if (code !== undefined)
    {
        switch (code)
        {
            case 200:
            {
                sText = 'Success';
                break;
            }
            case 404:
            {
                sText = 'Error';
                break;
            }
            case 403:
            {
                sText = 'Error';
                break;
            }
            case 500:
            {
                sText = 'Error';
                break;
            }
            default:
            {
                sText = 'Error';
            }

        }
    }
    return sText;
}

var Custom = function () {

    // private functions & variables

    var dispMessage = function (sType, sText) {
        toastr[sType.toLowerCase()](sText, sType);
    }

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.            
        },

        //some helper function
        myNotification: function (sType, sText) {
            dispMessage(sType, sText);
        }

    };
}();