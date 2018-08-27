@extends('layout.bootstrap.base')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <div>
        <br>
        <br>
        <br>
        <h4>
          How many numbers contain the word 14 from number 1 to 1,000,000 ?
        </h4>
      </div>
      <div id="main"></div>
    </div>
  </div>
</div>
@endsection

@section('body')
<script>
    var debug = true;
    var _debug = !true;
</script>

<!-- iteration method -->
<script>
    function howMany14UsingIteration(from, to){
        var numbers = [];
        for(var i = from;i <= to;i++){
            if(i.toString().indexOf('14') > -1){
                numbers.push(i);
            }
        }
        $(main).append(
            +from+" - "+to+" = "+numbers.length
            +"<br>"
        );
        if(_debug){
            document.write(
                "The numbers are: "+numbers.join(", ")
                +"<br>"
            );
        }
    }
</script>

<!-- pattern method -->
<script>
    function count_number(x, y){
        var x_digit = x.toString().length;
        var y_digit = (y-1).toString().length;
        if(x_digit < 2){
            x_digit = 2;
        }
        if(x_digit == y_digit){
            return 1;
        } else {
            var space = y_digit - x_digit;
            var head_duplication_number = y.toString().length - x_digit;
            var total_number_with_duplication = head_duplication_number
                + Math.pow(10, space).toString().replace(1, '');
            var duplication_number = find_duplication(y_digit, x_digit);
            var total_number = total_number_with_duplication
                - duplication_number;
            return total_number;
        }
        return 0;
    }

    function howMany14UsingPattern(from, to){
        $(main).append(
            +from+" - "+to+" = "+count_number(from, to)
            +"<br>"
        );
    }

    function find_duplication(y_digit, x_digit){
        if(y_digit < 4)return 0;
        if(y_digit == 4){
            return 1;
        } else {
            var x_count = 2;
            var array_possibilities = [];
            while(x_count*x_digit <= y_digit){
                array_possibilities.push(
                    find_moving_possibilities(y_digit, x_digit, x_count)
                );
                x_count++;
            }
            for(var i = array_possibilities.length-2;i >= 0;i--){
                array_possibilities[i] = 
                    array_possibilities[i] - array_possibilities[i+1];
                array_possibilities[i+1] = 0;
            }
            return array_possibilities[0];
        }
    }

    function find_moving_possibilities(y_digit, x_digit, x_count){
        if(x_digit*x_count == y_digit)return 1;
        var the_rest = y_digit-(x_digit*x_count);
        var combination_count = 
            factorial(the_rest+x_count)/
            (factorial(the_rest)*factorial(x_count));
        var return_value = 
            convert_combination_to_number(combination_count, the_rest);
        return return_value;
    }

    function convert_combination_to_number(combination_count, the_rest){
        var value = parseInt("1"+recursive_zero(the_rest));
        return combination_count*value;
    }

    function recursive_zero(number){
        if(number==0)return "";
        return recursive_zero(number-1)+"0";
    }

    function factorial(number){
        if(number==1)return 1;
        return number*factorial(number-1);
    }

    if(debug){
        // howMany14UsingIteration(1, 100);
        // howMany14UsingIteration(1, 1000);
        // howMany14UsingIteration(1, 10000);
        // howMany14UsingIteration(1, 100000);
        // howMany14UsingIteration(1, 1000000);

        // $(main).append('<hr>');
        
        howMany14UsingPattern(1, 100);
        howMany14UsingPattern(1, 1000);
        howMany14UsingPattern(1, 10000);
        howMany14UsingPattern(1, 100000);
        howMany14UsingPattern(1, 1000000);
    }else{
        howMany14UsingPattern(1, 10000);
        howMany14UsingPattern(1, 10000000);
        howMany14UsingPattern(1, 10000000000);
    }
</script>
@endsection