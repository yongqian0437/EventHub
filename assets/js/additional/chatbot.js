$(document).ready(function () {

  if (new_chat === "no") {
      load_history(current_con_id);
      $('#new_chat_info').hide();
  } else {
      $('#conversation_list').append('<div onclick="open_new_chat()" class="card shadow chatbubble mb-5" style=" color: black;">' +
          '<div class="card-body">' +
          '+ &nbsp New chat' +
          '</div>' +
          '</div>');

  }

});


function enter_prompt(text = "default value") {

  //Check if user click on recommended prompt
  if (text === "default value") {
      var prompt = $('#user_prompt').text();
  }
  else {
      var prompt = text;
  }

  if (prompt !== '') {

      //loading
      Swal.fire({
          title: 'The chatbot is responding...',
          html: 'Please wait...',
          allowEscapeKey: false,
          allowOutsideClick: false,
          didOpen: () => {
              Swal.showLoading()
          }
      });

      $('#new_chat_info').hide();

      //append user prompt text
      $('#conversation_body').append('<div class="row py-2 mr-5 my-1 ml-2">' +
          '    <div class="card chatbubble mr-4" style="background-color: #eaeaea; color: black; ">' +
          '        <div class="card-body">' +
          '            ' + prompt + '' +
          '        </div>' +
          '    </div>' +
          '</div>');


      $.ajax({
          url: base_url + "chatbot/generate_response",
          type: 'POST',
          data: {
              prompt: prompt,
              new_chat: new_chat,
              con_id: current_con_id
          },
          dataType: "json",
          success: function (response) {

              //Close loading pop up
              swal.close();

              // //change global variable so its NOT a new chat
              // var delay = 20; // Delay in milliseconds between each character

              // //append gpt response text
              // $('#conversation_body').append('<div class="row py-2 ml-5 my-1 mr-2 justify-content-end">' +
              //     '    <div class="card chatbubble ml-4" style="background-color: #007aff; color: white;">' +
              //     '        <div class="card-body response-card"></div>' +
              //     '    </div>' +
              //     '</div>');

              // // Append text with the writing effect
              // appendTextWithDelay(response, delay);

              $('#conversation_body').append(`
                      <div class="row py-2 ml-5 my-1 mr-2 justify-content-end">
                          <div class="card chatbubble ml-4" style="background-color: #007aff; color: white;">
                              <div class="card-body response-card">${response}</div>
                          </div>
                      </div>
                  `);

          },
          error: function (xhr, status, error) {
              Swal.fire({
                  icon: 'error',
                  title: 'There was an error generating your response, please try again',
              })
          }
      });
      load_conversation(current_con_id);
      append_new_card();
      new_chat = "no";

  }
}

function append_new_card() {
  //Append new card to conversation list if its a new chat
  if (new_chat === "yes") {

      //ajax to get latest added conversation history row id
      $.ajax({
          url: base_url + "chatbot/get_latest_con_id",
          method: "GET",
          dataType: "json",
          success: function (response) {

              //set current con_id to newly created con_id
              current_con_id = response.con_id;

              load_conversation(current_con_id);


          },
          error: function (xhr, status, error) {
              // Handle errors, if any
              console.error(error);
          }
      });

  }
}

function open_new_chat() {
  new_chat = "yes";
  current_con_id = 0;
  load_conversation(current_con_id);
  $('#conversation_body').empty();
  $('#conversation_body').append(`
  <div class="row justify-content-center py-2 pt-5" id="new_chat_info" style="padding-left: 20%; padding-right:20%">
      <div class="col-md-4 text-center">
          <i class="fas fa-lightbulb pr-2" style="color:#ffcd0a; font-size: 2.0rem;"></i>
          <div class="pb-2" style="font-weight:bold; font-size: 1.2rem;">Examples</div>
          <button type="button" onclick="enter_prompt('What is the difference between Alzheimer’s disease and dementia?')" class="btn btn-outline-dark mb-2">What is the difference between Alzheimer’s disease and dementia?</button><br>
          <button type="button" onclick="enter_prompt('What are the early signs of Alzheimer’s disease?')" class="btn btn-outline-dark mb-2">What are the early signs of Alzheimer’s disease?</button><br>
          <button type="button" onclick="enter_prompt('What are the stages of Alzheimer’s disease?')" class="btn btn-outline-dark">What are the stages of Alzheimer’s disease?</button>
      </div>
      <div class="col-md-4 text-center">
          <i class="fas fa-bolt pr-2" style="color:#007AFF; font-size: 2.0rem;"></i>
          <div class="pb-2" style="font-weight:bold; font-size: 1.2rem;">Capabilities</div>
          <button disabled type="button" class="btn btn-outline-dark mb-2">Remembers what user said earlier in the conversation</button><br>
          <button disabled type="button" class="btn btn-outline-dark mb-2">Allows user to provide follow-up corrections</button><br>
          <button disabled type="button" class="btn btn-outline-dark">Trained to decline inappropriate requests</button>
      </div>
      <div class="col-md-4 text-center">
          <i class="fas fa-exclamation pr-2" style="color:#FF0000; font-size: 2.0rem;"></i>
          <div class="pb-2" style="font-weight:bold; font-size: 1.2rem;">Limitation</div>
          <button disabled type="button" class="btn btn-outline-dark mb-2">May occasionally generate incorrect information</button><br>
          <button disabled type="button" class="btn btn-outline-dark mb-2">May occasionally produce harmful instructions or biased content</button><br>
          <button disabled type="button" class="btn btn-outline-dark">Limited knowledge of world and events after 2021</button>
      </div>
  </div>
`);

}


function appendTextWithDelay(text, delay) {
  var index = 0;
  var cardBody = $('.response-card:last');

  var interval = setInterval(function () {
      cardBody.append(text[index]);
      index++;

      if (index >= text.length) {
          clearInterval(interval);
      }
  }, delay);
}

// Dealing with Textarea Height
function calcHeight(value) {
  let numberOfLineBreaks = (value.match(/\n/g) || []).length;
  // min-height + lines x line-height + padding + border
  let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;
  return newHeight;
}

let textarea = document.querySelector(".resize-ta");
textarea.addEventListener("keyup", () => {
  textarea.style.height = calcHeight(textarea.value) + "px";
});



function load_history(con_id) {

  //loading pop up
  Swal.fire({
      title: 'Loading your conversation...',
      html: 'Please wait...',
      allowEscapeKey: false,
      allowOutsideClick: false,
      didOpen: () => {
          Swal.showLoading()
      }
  });

  $.ajax({
      url: base_url + "chatbot/load_conversation_history",
      type: 'POST',
      data: {
          con_id: con_id,
      },
      dataType: "json",
      success: function (response) {

          //set new con_id
          current_con_id = con_id;

          $('#conversation_body').empty();


          //append chat history
          $.each(response, function (index, chat) {

              if (chat.role == 1) {

                  $('#conversation_body').append('<div class="row py-2 mr-5 my-1 ml-2">' +
                      '    <div class="card chatbubble mr-4" style="background-color: #eaeaea; color: black; ">' +
                      '        <div class="card-body">' +
                      '            ' + chat.message + '' +
                      '        </div>' +
                      '    </div>' +
                      '</div>');

              } else {

                  $('#conversation_body').append('<div class="row py-2 ml-5 my-1 mr-2 justify-content-end">' +
                      '    <div class="card chatbubble ml-4" style="background-color: #007aff; color: white;">' +
                      '        <div class="card-body response-card">' + chat.message + '</div>' +
                      '    </div>' +
                      '</div>');
              }

          });
          //Close loading pop up
          load_conversation(con_id);
          swal.close();

      },
      error: function (xhr, status, error) {
          Swal.fire({
              icon: 'error',
              title: 'There was an error loading your history, please try again',
          })
      }
  });
}

function load_conversation(con_id) {

  //check if user has conversation
  $.ajax({
      url: base_url + "chatbot/check_has_conversation",
      method: "GET",
      dataType: "json",
      success: function (response) {

          if (response === "yes") {

              $.ajax({
                  url: base_url + "chatbot/load_convo_card",
                  type: 'GET',
                  dataType: "json",
                  success: function (response) {


                      $('#conversation_list').empty();
                      //append new chat button
                      $('#conversation_list').append('<div onclick="open_new_chat()" class="card shadow chatbubble mb-5" style=" color: black;">' +
                          '<div class="card-body">' +
                          '+ &nbsp New chat' +
                          '</div>' +
                          '</div>');


                      //append chat history
                      $.each(response, function (index, card) {

                          if (card.con_id == current_con_id) {
                              $('#conversation_list').append('<div id="con' + card.con_id + '" class="card shadow convoclass chatbubble mt-2" style=" color: black; position: relative;">' +
                                  '<div class="card-body convobody">' +
                                  '<i class="fas fa-comments pr-2"></i>' + card.con_name + '' +
                                  '<div class="buttons_icon" id = "buttonset' + card.con_id + '" style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%);">' +
                                  '<button class="edit-button text-secondary" onclick ="edit_con_name(' + card.con_id + ')" title="Edit" style="background-color: white; border: none;"><i class="fas fa-edit"></i></button>' +
                                  '<button class="delete-button text-secondary" onclick ="delete_conversation(' + card.con_id + ')" title="Delete" style="background-color: white; border: none;"><i class="fas fa-trash"></i></button>' +
                                  '</div>' +
                                  '</div>' +
                                  '</div>');
                          } else {
                              $('#conversation_list').append('<div onclick="load_history(' + card.con_id + ')" id="con' + card.con_id + '" class="card shadow convoclass chatbubble mt-2" style=" color: black; position: relative;">' +
                                  '<div class="card-body convobody">' +
                                  '<i class="fas fa-comments pr-2"></i>' + card.con_name + '' +
                                  '</div>' +
                                  '</div>');
                          }

                      });

                      //Make active card effect
                      //Unset all card css
                      $('.convoclass').css({
                          'color': 'black',
                          'font-weight': 'normal'
                      });
                      //Set card as active
                      $('#con' + con_id).css({
                          'color': '#007aff',
                          'font-weight': 'bold'
                      });


                  },
                  error: function (xhr, status, error) {
                      Swal.fire({
                          icon: 'error',
                          title: 'There was an error loading your converation history, please try again',
                      })
                  }
              });
          }

      },
      error: function (xhr, status, error) {
          // Handle errors, if any
          console.error(error);
      }
  });


}

function edit_con_name(con_id) {

  Swal.fire({
      title: 'Enter a name',
      input: 'text',
      inputPlaceholder: 'Conversation name',
      showCancelButton: true,
      confirmButtonText: 'Submit',
      cancelButtonText: 'Cancel',
      preConfirm: (value) => {
          if (!value) {
              return Swal.showValidationMessage('Please enter a name');
          }
      }
  }).then((result) => {
      if (result.isConfirmed) {

          $.ajax({
              url: base_url + "chatbot/edit_conversation_name",
              type: 'POST',
              data: {
                  con_id: con_id,
                  con_name: result.value
              },
              success: function (response) {

                  Swal.fire({
                      icon: 'success',
                      title: 'The name has been edited',
                  })

                  load_conversation(con_id);

              },
              error: function (xhr, status, error) {
                  // Handle errors, if any
                  Swal.fire({
                      icon: 'error',
                      title: 'There was an error editing your conversation',
                  })

              }
          });

      }
  });
}

function delete_conversation(con_id) {

  Swal.fire({
      text: 'Are you sure you want to permanently delete this conversation?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#1cc88a',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
  }).then((result) => {
      if (result.isConfirmed) {

          $.ajax({
              url: base_url + "chatbot/delete_conversation",
              type: 'POST',
              data: {
                  con_id: con_id
              },
              success: function (response) {

                  window.location.href = base_url + "chatbot";

              },
              error: function (xhr, status, error) {
                  // Handle errors, if any
                  Swal.fire({
                      icon: 'error',
                      title: 'There was an error deleting your conversation',
                  })

              }
          });

      }
  })
}