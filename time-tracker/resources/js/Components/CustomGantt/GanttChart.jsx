import React, { useEffect } from 'react';
import Gantt from '@/Components/CustomGantt/index';
import '@/Components/CustomGantt/gantt.scss';
import { useRef } from 'react';

const GanttChart = () => {
  const ganttTargetRef = useRef(null); // Tạo ref để tham chiếu đến phần tử DOM

  useEffect(() => {
    if (ganttTargetRef.current) { // Kiểm tra nếu ref đã được gắn vào phần tử DOM
      let tasks = [
        {
          start: '2024-08-01',
          end: '2024-08-01',
          name: 'Redesign website',
          id: "Task 0",
          progress: 30
        },
        {
          start: '2024-08-26',
          duration: '6d',
          name: 'Write new content',
          id: "Task 1",
          progress: 5,
          important: true
        },
        {
          start: '2024-04-04',
          end: '2024-04-08',
          name: 'Apply new styles',
          id: "Task 2",
          progress: 80,
          dependencies: 'Task 1'
        },
        {
          start: '2024-04-08',
          end: '2024-04-09',
          name: 'Review',
          id: "Task 3",
          progress: 5,
          dependencies: 'Task 2'
        },
        {
          start: '2024-04-08',
          end: '2024-04-10',
          name: 'Deploy',
          id: "Task 4",
          progress: 0,
        },
        // {
        //     start: '2024-08-12',
        //     end: '2024-08-12',
        //     name: 'Go Live!',
        //     id: "Task 5",
        //     progress: 0,
        //     dependencies: 'Task 2',
        //     custom_class: 'bar-milestone'
        //   }
      ];

      tasks = [...tasks, ...Array.from({length: tasks.length * 3}, (_, i) => ({...tasks[i % 3], id: i}))];

      const gantt_chart = new Gantt(ganttTargetRef.current, tasks, { // Sử dụng ref để lấy phần tử DOM
        on_click: (task) => {
          console.log("Click", task);
        },
        view_mode: "Hour",
        view_mode_padding: { DAY: "3d" },
        popup: false,
      });

      console.log(gantt_chart);
    }
  }, []);

  return (
    <div className="container">
      <div className="gantt-target" ref={ganttTargetRef}></div> {/* Gắn ref vào phần tử DOM */}
    </div>
  );
};

export default GanttChart;

