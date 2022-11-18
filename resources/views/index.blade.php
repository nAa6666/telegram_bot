<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Telegram</title>
        <style>
            label{display: block;width: 100%;font-weight: bold;}
            input, textarea{width: 100%;padding: 10px;border: 1px solid #aaa;border-radius: 5px;margin: 5px 0 20px;}
            form{width: 600px;margin: 50px auto 0;}
            button{padding: 10px 20px;background: #5858ff;border: 1px solid blue;color: white;border-radius: 5px;}
            .alert{padding: 10px;margin: 0 0 20px;border-radius: 5px;width: 100%;}
            .success{background: #18f643}
            .danger{background: #ff918b}
        </style>
    </head>
    <body>
        <div id="form">
            <form action="{{route('send')}}" method="POST">
                @csrf
                @include('notifications.alert-all')
                <div>
                    <label for="formControlInputTitle" class="form-label">Title*</label>
                    <input type="text" class="form-control" name="title" id="formControlInputTitle" placeholder="Title" value="{{old('title')}}" required/>
                </div>
                <div>
                    <label for="formControlInputText" class="form-label">Text*</label>
                    <textarea name="text" id="formControlInputText" rows="10" cols="80" placeholder="Text">{{old('text')}}</textarea>
                </div>
                <button type="submit">Send</button>
            </form>
        </div>
    </body>
</html>
