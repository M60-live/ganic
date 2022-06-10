<!-- POPUP SECTION -->
<div class="modal fade" id="campaignPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background-color: rgba(3, 76, 69,0.4);">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #f4f4f4; border-radius: 10px;">
            {{--<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>--}}
            <div class="modal-body text-center">
                <h3 class="text-center pt-3 pb-2" id="campaign_subject">Which product would <br>you like to see more?</h3>
                <img src="{{ asset('/img/letter-G.png') }}" class="img-responsive col-6" alt="letter-G" />
                <form action="/campaign" method="post" class="pt-3" id="campaign_form">
                    <div class="form-group">
                        <select class="form-control offset-md-3 col-md-6" name="answer_options" id="answer_options">
                            <option value="">select one option:</option>
                            <option value="Bath bombs">Bath bombs</option>
                            <option value="Face Serums">Face Serums</option>
                            <option value="Bath Soaps">Bath Soaps</option>
                            <option value="Shea Butter">Shea Butter</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submitBtn" class="btn btn-primary" disabled="disabled">send</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{--<a href="#"  data-dismiss="modal">not interested</a>--}}
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">later</button>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    $(document).ready(function (){

        var campaign_subject = $('#campaign_subject').text();
        if(window.localStorage.getItem(campaign_subject) === null)
        {
            var showPopup = setInterval( function(){

                $('#campaignPopup').modal('show');

                var formData=[];

                $('#answer_options').on('change',function(){
                    if($(this).val() !== "")
                    {
                        $('#submitBtn').removeAttr('disabled');
                    }
                    else
                    {
                        $('#submitBtn').attr('disabled','disabled');
                    }
                });

                $('#campaign_form').on('submit',function(e){
                    e.preventDefault();

                    var answer_options = $('#answer_options').val();

                    $.ajax({
                        url:'/campaign',
                        type:'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{campaign_subject:campaign_subject,answer_options:answer_options, _token: $('meta[name="csrf-token"]').attr('content')},
                        beforeSend:function(){
                            $('#submitBtn').html("Sending...");
                            $('#submitBtn').attr('disabled','disabled');
                        },
                        success:function(data){
                            let response = JSON.parse(data);
                            if(response.status=='ok')
                            {
                                $('#submitBtn').html("Message Sent");
                                //*** then set completed flag so that this popup doesn't show again
                                window.localStorage.setItem(campaign_subject, "1");

                                var fadeTimer = setInterval(function(){
                                    $('#campaignPopup').modal('hide');
                                    clearInterval(fadeTimer);
                                },3000);
                            }
                            else
                            {
                                $('#submitBtn').html("Something went wrong.");
                            }
                        }
                    });

                    return false;
                });

                clearInterval(showPopup);

            },1000);
        }

    });
</script>