<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chat GPT Laravel | Noor Elahi Ali Shibly</title>
  <link rel="icon" href="https://t1.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=https://daffodilvarsity.edu.bd/&size=48"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- End JavaScript -->

  <!-- CSS -->
  <link rel="stylesheet" href="/style.css">
  <!-- End CSS -->

</head>

<body>
<div class="chat">

  <!-- Header -->
  <div class="top">
    <img src="https://lh3.googleusercontent.com/a/ACg8ocK9j9gLXGe6V-YwBlT0sS0j9WpNa3YYRSeg_Gmm3ozp0WiSuqiH=s317-c-no" alt="Avatar" width="300">
    <div>
      <p>Noor Elahi Ali Shibly</p>
      <small>Online</small>
    </div>
  </div>
  <!-- End Header -->

  <!-- Chat -->
  <div class="messages">
    <div class="left message">
      <img src="https://lh3.googleusercontent.com/a/ACg8ocK9j9gLXGe6V-YwBlT0sS0j9WpNa3YYRSeg_Gmm3ozp0WiSuqiH=s317-c-no" alt="Avatar">
      <p>Start chatting with Chat GPT AI below!!</p>
    </div>
  </div>
  <!-- End Chat -->

  <!-- Footer -->
  <div class="bottom">
    <form>
      <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
      <button type="submit"></button>
    </form>
  </div>
  <!-- End Footer -->

</div>
</body>

<script>
  //Broadcast messages
  $("form").submit(function (event) {
    event.preventDefault();

    //Stop empty messages
    if ($("form #message").val().trim() === '') {
      return;
    }

    //Disable form
    $("form #message").prop('disabled', true);
    $("form button").prop('disabled', true);

    $.ajax({
      url: "/chat",
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      },
      data: {
        "model": "gpt-3.5-turbo",
        "content": $("form #message").val()
      }
    }).done(function (res) {

      //Populate sending message
      $(".messages > .message").last().after('<div class="right message">' +
        '<p>' + $("form #message").val() + '</p>' +
        '<img src="https://lh3.googleusercontent.com/a/ACg8ocK9j9gLXGe6V-YwBlT0sS0j9WpNa3YYRSeg_Gmm3ozp0WiSuqiH=s317-c-no" alt="Avatar">' +
        '</div>');

      //Populate receiving message
      $(".messages > .message").last().after('<div class="left message">' +
        '<img src="https://t0.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=https://chatgpt.com/?oai-dm=1&size=128" alt="Avatar">' +
        '<p>' + res + '</p>' +
        '</div>');

      //Cleanup
      $("form #message").val('');
      $(document).scrollTop($(document).height());

      //Enable form
      $("form #message").prop('disabled', false);
      $("form button").prop('disabled', false);
    });
  });

</script>
</html>
