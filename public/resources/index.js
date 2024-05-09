const fileSubmit = {
    submit: () => {
        const fileInput = $('#file')[0].files[0]; // Get the file object
        const fileName = fileInput.name;

        // Create a FormData object and append the file to it
        let formData = new FormData();
        formData.append('file', fileInput);

        let sliderVal = $('#slider').val();

        $('.left, .right').css('display', 'none');

        // Send a POST request to the server
        $.ajax({
            url: './actions/index.php?parseFile=true' + '&sliderVal=' + sliderVal, // Specify the URL of the server-side script
            type: 'POST',
            data: formData,
            contentType: false, // Don't set contentType
            processData: false, // Don't process data
            success: function(response){
                // Handle success response from the server
                response = JSON.parse(response);
                if (!response.errors.length) {
                    $('.copy-feedback').text('');
                    $('#clean').html(response.data.cleanStr);
                    $('#timestampClean').html(response.data.timestampStr)
                    $('.left, .right').css('display', 'inline-block');
                    $('.file-name').text(fileName);
                }
            },
            error: function(xhr, status, error){
                alert(error);
            }
        });
    }
}

const copyButtons = {
    clicked: (targetId) => {
        let html = $(targetId)[0].innerHTML;

        let textContent = html.replace(/<br>/g, '\n');

        let tmpTextArea = $('<textarea>').html(textContent).appendTo('body').select();

        document.execCommand('copy');

        tmpTextArea.remove();

        $('.copy-feedback').text('');
        $(targetId + 'Feedback').text('Text copied!');
    }
}

const alertModal = {

}
