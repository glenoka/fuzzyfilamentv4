<div class="min-h-screen bg-gray-50 p-6">
  <!-- Timer -->
  <div class="text-center mb-6">
    <div id="countdown" class="text-2xl font-bold text-red-600">00:00</div>
  </div>

  <div class="flex justify-center gap-8">
    <!-- Card Soal (hardcode) -->
    <div class="bg-white rounded-2xl shadow-md p-6 w-[500px]">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">
        {{ $currentPackageQuestion->question->question }}
      </h2>

      <div class="space-y-3">
        @foreach ($currentPackageQuestion->question->options as $option)
        <label class="flex items-center gap-2 cursor-pointer">
          <input class="form-check-input" type="radio" @if ($timeLeft <=0) disabled @endif
            name="answer_{{ $currentPackageQuestion->question_id }}" value="{{ $option->id }}"
            wire:key="{{ $option->id }}"
            wire:click="saveAnswer({{ $currentPackageQuestion->question_id }}, {{ $option->id }})"
            @if ($selectedAnswers[$currentPackageQuestion->question_id] == $option->id) checked @endif>
          <span class="text-gray-700"> {{ $option->option_text }}</span>
        </label>

        @endforeach
      </div>
    </div>

    <!-- Navigasi Soal -->
    <div class="bg-white rounded-2xl shadow-md p-6 w-64 flex flex-col items-center">
      <div class="grid grid-cols-5 gap-3 mb-6">

        @foreach ($Questions as $index => $question)
        @php
        $isActive = $question->question_id == $currentPackageQuestion->question_id;
        $isAnswered = isset($selectedAnswers[$question->question_id]) && !is_null($selectedAnswers[$question->question_id]);
        @endphp
        <button

          @if ($timeLeft <=0) disabled @endif
          class="w-10 h-10 rounded-lg font-medium transition {{ $isAnswered ? 'bg-green-500 text-white hover:bg-green-600' : ($isActive ? 'bg-blue-500 text-white hover:bg-blue-600' : 'border border-blue-500 text-blue-500 bg-transparent hover:bg-blue-500 hover:text-white hover:border-transparent') }}"
          data-question-id="{{ $question->question_id }}"
          wire:click="goToQuestion({{ $question->question_id }})">
          {{ $index + 1 }}
        </button>



        @endforeach
      </div>

      <button wire:click="submit" onclick="return confirm('Apakah anda yakin ingin mengirim jawaban ini?')"
        class="w-full py-2 rounded-xl bg-blue-500 text-white font-semibold hover:bg-blue-600 transition">
        Submit Exam
      </button>
    </div>
  </div>
  @if(session()->has('message'))
    <div class="bg-green-100 border border-green-400  text-green-700 px-4 py-3 rounded-lg relative mb-4 text-center" role="alert">
        <span class="block sm:inline">{{ session('message') }}</span>
    </div>
@endif

  <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timeLeft = {{ $timeLeft }};
            startCountdown(timeLeft, document.getElementById('countdown'));
            Livewire.on('examFinished', () => {
                window.location.reload();
            });
        });

        function startCountdown(duration, display) {
            let timer = duration,
                minutes, seconds;
            setInterval(function() {
                hours = parseInt(timer / 3600, 10);
                minutes = parseInt((timer % 3600) / 60, 10);
                seconds = parseInt(timer % 60, 10);

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = hours + ":" + minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = 0;
                }
            }, 1000);
        }
    </script>
</div>