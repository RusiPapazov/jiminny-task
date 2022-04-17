# Solution for [Waveform Generator  Jiminny task](https://github.com/jiminny/join-the-team/blob/master/backend-task.md)

## Usage:

```shell
git clone git@github.com:RusiPapazov/jiminny-task.git
composer install
./bin/execute https://raw.githubusercontent.com/jiminny/join-the-team/master/assets/user-channel.txt https://raw.githubusercontent.com/jiminny/join-the-team/master/assets/customer-channel.txt > result.json
```

There is a third argument, that is cache time in seconds, defaults to 3600.

## Notes

### Faulty data found:
Silence starts before the previous one ends. It is taken into consideration in the current implementation.
```
silence_end: 1197.57
silence_start: 1197.49
```

