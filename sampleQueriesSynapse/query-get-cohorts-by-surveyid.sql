SELECT 
	ws.cohort_code as cohort_id, 
    sl.name as name, 
    ws.org_id as org, 
    ws.survey_id as survey, 
    count(osl.person_id) as total_students,
    ws.open_date as open_date,
    ws.close_date as close_date
FROM org_person_student_survey_link osl 
LEFT JOIN wess_link ws ON (ws.org_id = osl.org_id AND ws.survey_id = osl.survey_id AND ws.cohort_code = osl.cohort)
LEFT JOIN survey_lang sl ON osl.survey_id = sl.survey_id
WHERE ws.org_id = 91 
AND ws.survey_id = 11
AND osl.person_id IN (#--EXPLAIN
			SELECT DISTINCT merged.student_id
			FROM
                (#-- Associated group with this advisor
					SELECT S.person_id AS student_id,
						#--F.person_id AS faculty_id, #--removed due to pushdown
						F.org_permissionset_id AS permissionset_id
					FROM org_group_students AS S
					INNER JOIN org_group_faculty AS F ON F.org_group_id = S.org_group_id and F.deleted_at is null
					WHERE S.deleted_at is null  AND F.person_id=61801 #--We manually push down the faculty criteria for performance
					UNION ALL #-- Associated course with this advisor
						SELECT S.person_id AS student_id,
								#--F.person_id AS faculty_id, #--removed due to pushdown
							   F.org_permissionset_id AS permissionset_id
                                FROM org_course_student AS S
                                INNER JOIN org_courses AS C ON C.id = S.org_courses_id AND C.deleted_at is null
                                INNER JOIN org_course_faculty AS F ON F.org_courses_id = S.org_courses_id AND F.deleted_at is null
                                INNER JOIN org_academic_terms AS OAT ON OAT.id = C.org_academic_terms_id  AND OAT.end_date >= now() AND OAT.deleted_at is null
                                WHERE S.deleted_at is null  AND F.person_id=61801 #--We manually push down the faculty criteria for performance
                 ) AS merged
			INNER JOIN org_person_student AS P ON P.person_id=merged.student_id AND P.deleted_at IS NULL AND P.organization_id = 91
			INNER JOIN org_permissionset OPS ON merged.permissionset_id = OPS.id AND OPS.accesslevel_ind_agg = 1
			#  AND OPS.risk_indicator = 1 #This check is not required to get student ids
			#--We pushed down this criteria for performance
			#--WHERE
			#--          merged.faculty_id = 2
			)
GROUP BY ws.cohort_code;