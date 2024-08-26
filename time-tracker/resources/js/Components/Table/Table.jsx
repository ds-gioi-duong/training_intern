import React from 'react';
import '../../../css/table/Table.css';

const times = [
  '01:00', '02:00', '03:00', '04:00', '05:00', '06:00',
  '07:00', '08:00', '09:00', '10:00', '11:00', '12:00',
  '13:00', '14:00', '15:00', '16:00', '17:00', '18:00',
  '19:00', '20:00', '21:00', '22:00', '23:00'
];

const tasks = [
  { id: 1, name: 'Task 1', start: '03:15', end: '05:30' },
  { id: 2, name: 'Task 2', start: '07:00', end: '10:45' },
  { id: 3, name: 'Task 3', start: '12:15', end: '13:40' }
];

const getPercentage = (time, start, end) => {
  const [timeHour, timeMinute] = time.split(':').map(Number);
  const [startHour, startMinute] = start.split(':').map(Number);
  const [endHour, endMinute] = end.split(':').map(Number);

  const timeInMinutes = timeHour * 60 + timeMinute;
  const startInMinutes = startHour * 60 + startMinute;
  const endInMinutes = endHour * 60 + endMinute;

  if (timeInMinutes < startInMinutes || timeInMinutes >= endInMinutes) {
    return 0;
  }

  const duration =60;
  const timeElapsed = timeInMinutes - startInMinutes;
  return Math.min((timeElapsed / duration) * 100, 100);
};

const Table = () => {
  return (
    <div className="timesheet">
      <table>
        <thead>
          <tr>
            <th>Task</th>
            {times.map((time, index) => (
              <th key={index}>{time}</th>
            ))}
          </tr>
        </thead>
        <tbody>
          {tasks.map((task) => (
            <tr key={task.id}>
              <td>{task.name}</td>
              {times.map((time, index) => {
                const timeStart = time;
                const timeEnd = times[index + 1] || '23:59'; // End time of the last slot

                const startPercentage = getPercentage(timeStart, task.start, task.end);
                const endPercentage = getPercentage(timeEnd, task.start, task.end);

                const background = startPercentage || endPercentage
                  ? `linear-gradient(to right, #4CAF50 ${startPercentage}%, transparent ${endPercentage}%)`
                  : 'transparent';

                return (
                  <td
                    key={index}
                    className="time-cell"
                    style={{ background }}
                  ></td>
                );
              })}
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Table;
